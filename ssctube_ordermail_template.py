#!/usr/bin/python
import smtplib
import sys
import settings
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

def prompt(prompt):
    return raw_input(prompt).strip()

fromaddr = 'admin@ssctube.com'
toaddr  = sys.argv[1]
msg = MIMEMultipart('alternative')
msg['Subject'] = "Order Confirmation - "+sys.argv[2]+" - Your order with ssctube.com is successful"
msg['From'] = "admin@ssctube.com"
msg['To'] = sys.argv[1]

# Create the body of the message (a plain-text and an HTML version).
text = "Hi!\n\nThanks for your order at SSCTube.\n\n\n You will receive your product access within 24 hours.\n\n\nFor any further query related to your order, please contact:\n admin@ssctube.com\nOr\nWhatsapp @ 9582383798"
html = """\
<html>
  <head></head>
  <body>
    <p>Hi!<br><br>
       Thanks for your order at SSCTube.<br><br>
       You will receive your product access within 24 hours.<br>
    </p>
    <br><br>
    <p> For any further query related to your order, <br>
	please contact: <a href="mailto:admin@ssctube.com">admin@ssctube.com</a><br>
	Or<br>
	Whatsapp @ 9582383798<br><br>
   </p>	
  </body>
</html>
"""
# Record the MIME types of both parts - text/plain and text/html.
part1 = MIMEText(text, 'plain')
part2 = MIMEText(html, 'html')

# Attach parts into message container.
msg.attach(part1)
msg.attach(part2)

#print "Message length is " + repr(len(msg))

#Change according to your settings
smtp_server = settings.amazon_smtp['smtp_server']
smtp_username = settings.amazon_smtp['smtp_username']
smtp_password = settings.amazon_smtp['smtp_password']
smtp_port = settings.amazon_smtp['smtp_port']
smtp_do_tls = True

server = smtplib.SMTP(
    host = smtp_server,
    port = smtp_port,
    timeout = 10
)
server.set_debuglevel(10)
server.starttls()
server.ehlo()
server.login(smtp_username, smtp_password)
server.sendmail(fromaddr, toaddr, msg.as_string())
print server.quit()
