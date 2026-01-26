-- =================
-- Création de la db
-- =================
create database if not exists ticket_management;
use ticket_management;

-- ====================
-- Création des tables
-- ====================
create table if not exists `roles`(
id_role tinyint unsigned primary key auto_increment,
nom varchar(35) not null
);

create table if not exists `status`(
id_status tinyint unsigned primary key auto_increment,
nom varchar(35) not null
);

create table if not exists `types`(
id_type tinyint unsigned primary key auto_increment,
nom varchar(35) not null
);

create table if not exists priorities(
id_priority tinyint unsigned primary key auto_increment,
nom varchar(35) not null
);

create table if not exists users(
id_user int unsigned primary key auto_increment,
fname varchar(50) not null,
lname varchar(50) not null,
email varchar(50) not null,
phone_number varchar(20) ,
`password` varchar(250) not null,
role_id tinyint unsigned ,
foreign key (role_id) references roles (id_role)
);

create table if not exists clients(
id_client int unsigned primary key auto_increment,
fname varchar(50) not null,
lname varchar(50) not null,
email varchar(50) not null,
phone_number varchar(20)
);

create table if not exists devices (
id_device  int unsigned  key auto_increment,
model varchar (100) ,
serial_number varchar (100) ,
brand varchar (100) ,
type_id tinyint unsigned ,
client_id int unsigned ,
submission_date DateTime ,
retrieve_date DateTime ,
foreign key (client_id) references clients (id_client),
foreign key (type_id) references types (id_type)
);

create table if not exists tickets(
id_ticket int unsigned primary key auto_increment,
ticket_number varchar (100) not null,
client_id int unsigned,
device_id int unsigned,
status_id tinyint unsigned ,
priority_id tinyint unsigned ,
created_by int unsigned ,
foreign key (created_by) references users (id_user),
foreign key (client_id) references clients (id_client),
foreign key (device_id) references devices (id_device),
foreign key (status_id) references `status` (id_status),
foreign key (priority_id) references priorities (id_priority)
);


create table if not exists intervention (
-- id_intervention int unsigned primary key auto_increment,
ticket_id int unsigned,
user_id int unsigned,
start_at DateTime ,
end_at DateTime ,
primary key (ticket_id, user_id) ,
foreign key (ticket_id) references tickets (id_ticket),
foreign key (user_id) references users (id_user)
)
;
