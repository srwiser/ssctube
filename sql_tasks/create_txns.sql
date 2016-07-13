 create table txns(
 id int not null auto_increment,
 amount float,
 buyer varchar(200),
 buyer_name varchar(200),
 buyer_phone varchar(200),
 currency varchar(200),
 fees float,
 mac varchar(200),
 offer_slug varchar(200),
 offer_title varchar(200),
 payment_id varchar(200),
 quantity int,
 shipping_address varchar(200),
 shipping_city varchar(200),
 shipping_country varchar(200),
 shipping_state varchar(200),
 shipping_zip varchar(200),
 status varchar(200),
 unit_price float,
 primary key(id),
 key(buyer)
 );
