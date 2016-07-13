import hmac
import pprint
import hashlib 
import MySQLdb
import settings
from BaseHTTPServer import HTTPServer, BaseHTTPRequestHandler

import urlparse

import logging

LOG_FILENAME = '/tmp/transaction_status.log'
logging.basicConfig(filename=LOG_FILENAME,level=logging.INFO,filemode="w")

PORT = 8000
host = settings.mysql['host']
port = settings.mysql['port']
user = settings.mysql['user']
passwd = settings.mysql['password']
db = settings.mysql['db_name']


class MojoHandler(BaseHTTPRequestHandler):

  def do_POST(self):

    content_length = int(self.headers['content-length'])

    querystring = self.rfile.read(content_length)

    data = urlparse.parse_qs(querystring)

    mac_provided = data.pop('mac')

    message = "|".join(v[0] for k, v in sorted(data.items(), key=lambda x: x[0].lower()))

    # Pass the 'salt' without the <>.

    mac_calculated = [hmac.new("1b0f045982814f0d8f0cada3808ceece", message, hashlib.sha1).hexdigest()]

    mysql_connection=MySQLdb.connect(host = host, \
                                port = port, \
                                user = user, \
                                passwd = passwd, \
                                db = db)
    cursor = mysql_connection.cursor()
    query = 'INSERT INTO txns ({0}) VALUES ({1})'
    keys = ""
    values = ""
    obj_len = len(data)
    count = 0
    comma = ', '
    for key in data:
      count += 1
      quote = '"'
      if key in ['amount', 'fees', 'unit_price', 'quantity']:
        quote = ''
      if key in ['custom_fields', 'variants']:
        continue
      if count == obj_len:
        comma = ''
      
      value = data[key][0]
      value = value.replace('"', '\\"')
      value = value.replace("'", "\\'")
      values = '{0}{1}{2}{3}{4}'.format(values, quote, value, quote, comma)
      keys = '{0}{1}{2}'.format(keys, key, comma)
    
    if mac_provided == mac_calculated:
     
      if data['status'] == ['Credit']:

        cursor.execute(query.format(keys, values))
        mysql_connection.commit()
        logging.info("Transaction Success for "+data['buyer_name'][0]+" Ph: "+data['buyer_phone'][0]+" Email: "+data['buyer'][0]+" with PaymentID= "+data['payment_id'][0])
        self.send_response(200)
      else:
        cursor.execute(query.format(keys, values))
        mysql_connection.commit()
        logging.info("Failed Transaction for "+data['buyer_name'][0]+" Ph: "+data['buyer_phone'][0]+" Email: "+data['buyer'][0]+" with PaymentID= "+data['payment_id'][0])
        self.send_response(200)

    else:

      self.send_response(400)

    self.send_header('Content-type', 'text/html')

    self.end_headers()

httpd = HTTPServer(('', PORT), MojoHandler)

httpd.serve_forever()
