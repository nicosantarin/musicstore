create database music_sc;

use music_sc;

create table customers
(
  customerid char(40) not null primary key,
  password char(55) not null,
  name char(60) not null,
  address char(80) not null,
  city char(30) not null,
  state char(20),
  zip char(10),
  country char(20) not null
);

create table orders
(
  orderid int unsigned not null auto_increment primary key,
  customerid int unsigned not null,
  amount float(6,2),
  date date not null,
  order_status char(10),
  ship_name char(60) not null,
  ship_address char(80) not null,
  ship_city char(30) not null,
  ship_state char(20),
  ship_zip char(10),
  ship_country char(20) not null
);

create table books
(
   upc char(13) not null primary key,
   author char(80),
   title char(100),
   catid int unsigned,
   price float(4,2) not null,
   publisher varchar(30),
   year char(4)
);

create table discs
(
   upc char(13) not null primary key,
   artist char(80),
   title char(100),
   catid int unsigned,
   price float(4,2) not null,
   producer varchar(100),
   year char(4),
   tracks char(255),
   genre char(20)
);

create table tracklist
(
   upc char(20) not null,
   name char(255) not null primary key,
   album char(20)
);

create table scores
(
   upc char(13) not null primary key,
   composer char(80),
   title char(100),
   catid int unsigned,
   price float(4,2) not null,
   publisher varchar(100)
);

create table supplier
(
   name char(20) not null primary key,
   address char(35),
   city char(30)
);


create table categories
(
  catid int unsigned not null auto_increment primary key,
  catname char(60) not null
);

create table order_items
(
  orderid int unsigned not null,
  upc char(13) not null,
  item_price float(4,2) not null,
  quantity tinyint unsigned not null,
  primary key (orderid, upc)
);

create table admin
(
  username char(16) not null primary key,
  password char(40) not null
);


grant select, insert, update, delete
on music_sc.*
to music_sc@localhost identified by 'password';
