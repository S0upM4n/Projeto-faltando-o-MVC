drop database if exists notes;
create database  if not exists notes;
use notes;
create table users(
	username varchar(255) not null,
    password varchar(255) not null,
    id int primary key auto_increment,
    uuid char(36)
);
select * from users;