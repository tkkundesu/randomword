drop database if exists heroku_20a8da0826c37ac;
create database heroku_20a8da0826c37ac default character set utf8 collate utf8_general_ci;
grant all on heroku_20a8da0826c37ac.* to 'b32baaefe5fd4d'@'us-cdbr-iron-east-02.cleardb.net' identified by '70c23554';
use heroku_20a8da0826c37ac;


create table customer (
	id int auto_increment primary key, 
	name varchar(100) not null,
	login varchar(100) not null unique, 
	password varchar(100) not null
);

create table subject (
	id int auto_increment primary key, 
	customer_id int not null,
	kind varchar(200) not null,  
	foreign key(customer_id) references customer(id)
);

insert into customer values(null, '鈴木貴之', 'tkkun', 'tkkundesu');


insert into subject values(null, 1 , 'すべらない話をする');
insert into subject values(null, 1 , '最近の失敗した話をする');
insert into subject values(null, 1 , 'モノマネをする');
insert into subject values(null, 1 , '三回周ってワンという');
insert into subject values(null, 1 , '変顔をする');
insert into subject values(null, 1 , '秘密を話す');
