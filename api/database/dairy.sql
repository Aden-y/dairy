create database dairy;
use dairy;


create table if not exists users (
    id bigint primary key auto_increment not null,
    firstname varchar(50) not null,
    lastname varchar(50) not null,
    email varchar(50) not null,
    phone varchar(20) not null,
    national_id int(11) not null,
    type enum('Admin', 'Farmer', 'Vet', 'Agrovet', 'Employee'),
    registered_on datetime not null,
    password varchar(255) not null
);

create table if not exists addresses (
    id bigint primary key auto_increment not null,
    county varchar(50) not null,
    subcounty varchar(50) not null,
    ward varchar(50) not null,
    place varchar(50) not null,
    user_id bigint not null,
    foreign key (user_id) references users(id)

);

create table if not exists agrovets (
    id bigint primary key auto_increment not null,
    user_id bigint not null,
    name varchar(100) not null,
    verified boolean not null default 0,
    foreign key (user_id) references users(id)
);

create table if not exists vets(
    id bigint primary key auto_increment not null,
    user_id bigint not null,
    specialization varchar(255) not null,
    verified boolean not null default 0,
    foreign key (user_id) references users(id)
);

create table if not exists collection_point(
    id bigint primary key auto_increment not null,
    name varchar(255) not null,
    county varchar(30) not null,
    subcounty varchar(30) not null,
    ward varchar(30) not null,
    status enum('Closed', 'Open') not null default 'Closed',
    registered_on date not null,
    attendant bigint  null,
    unit_price double not null,
    foreign key (attendant) references users(id)
);

create table if not exists milk_collections (
    id bigint primary key auto_increment not null,
    farmer_id bigint not null,
    unit_price double not null,
    quantity double not null,
    point_id bigint not null,
    received_by bigint not null,
    received_at datetime not null,
    amount double not null,
    foreign key (farmer_id) references users(id),
    foreign key (point_id) references collection_point(id),
    foreign key (received_by) references users(id)
);

create table if not exists farmer_account(
    id bigint primary key auto_increment not null,
    farmer_id bigint not null,
    balance double not null default 0.0,
    divident double not null default 0.0,
    foreign key (farmer_id) references users(id)
);

create table if not exists agrovet_items (
    id bigint primary key auto_increment not null,
    name varchar(255) not null,
    category varchar (100) not null,
    description text not null,
    agrovet_id bigint not null,
    quantity bigint not null,
    added_on datetime not null,
    unit_price double not null
);

create table if not exists orders(
    id bigint primary key auto_increment not null,
    farmer_id bigint not null,
    made_on datetime not null,
    status enum ('In-Process', 'Complete') default 'In-Process',
    foreign key (farmer_id) references users(id)
);


create table if not exists order_items (
    id bigint primary key auto_increment not null,
    order_id bigint not null,
    item_id bigint not null,
    quantity double not null,
    unit_price double not null, 
    amount double not null,
    status enum('In-Process', 'Cancelled', 'Complete') default 'In-Process',
    foreign key (order_id) references orders(id) ,
    foreign key (item_id) references agrovet_items(id)    
);

create table if not exists vet_appointments(
    id bigint primary key auto_increment not null,
    farmer_id bigint not null,
    category varchar(50) not null,
    description text not null,
    created_on datetime not null,
    date datetime not null,
    status enum('Pending', 'Accepted','Cancelled', 'Rejected', 'Completed'),
    vet_id bigint  null,
    foreign key (vet_id) references users(id),
    foreign key (farmer_id) references users(id)
);


create table if not exists farmer_account_transaction_logs(
    id bigint primary key auto_increment not null,
    farmer_account_id bigint not null,
    type enum('Debit', 'Credit') not null,
    amount double not null,
    description text not null,
    date datetime not null,
    foreign key (farmer_account_id) references farmer_account(id)
);


CREATE TABLE IF NOT EXISTS vet_feedbacks(
    id BIGINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    appointment_id BIGINT NOT NULL ,
    problem TEXT NOT NULL ,
    feedback TEXT NOT NULL ,
    FOREIGN KEY (appointment_id) REFERENCES vet_appointments(id));
