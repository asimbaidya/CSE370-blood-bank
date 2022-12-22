-- SQl Query for project
-- In case You wanna clean this shits!
-- drop table search;
-- drop table hospital_contact;
-- drop table blood_bank_contact;
-- drop table blood_bag;
-- drop table user;
-- drop table hospital;
-- drop table admin;
-- drop table blood_bank;
-- !
create table
  admin (
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(100) NOT NULL UNIQUE KEY,
    password char(255) NOT NULL,
    first_name varchar(50) NOT NULL,
    last_name varchar(50),
    sex varchar(6) NOT NULL,
    date_of_birth date NOT NULL,
    role char(50) DEFAULT 'desk_admin',
    phone varchar(15) NOT NULL,
    image varchar(255) DEFAULT '/asset/admin-avater.png'
  );

create table
  user (
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(100) NOT NULL UNIQUE KEY,
    password varchar(255) NOT NULL,
    first_name varchar(50) NOT NULL,
    last_name varchar(50),
    sex varchar(6) NOT NULL,
    date_of_birth date NOT NULL,
    blood_group varchar(3) NOT NULL,
    image varchar(255) DEFAULT '/asset/user-avater-01.png',
    last_donated date DEFAULT null,
    last_received date DEFAULT null,
    phone varchar(15) NOT NULL,
    latitude float DEFAULT null,
    longitude float DEFAULT null
  );

create table
  search (
    id int PRIMARY KEY AUTO_INCREMENT,
    content text DEFAULT 'Request for Blood Donation',
    blood_group varchar(3) NOT NULL,
    search_status varchar(1) NOT NULL DEFAULT '0',
    request_time datetime NOT NULL,
    resolve_time datetime DEFAULT null,
    request_by int NOT NULL,
    resolve_by int DEFAULT null,
    Foreign key (request_by) references user (id) ON DELETE CASCADE,
    Foreign key (resolve_by) references user (id)
  );

create table
  hospital (
    id int PRIMARY KEY AUTO_INCREMENT,
    email varchar(100) NOT NULL UNIQUE KEY,
    password char(255) NOT NULL,
    name varchar(100) NOT NULL,
    address varchar(255) NOT NULL,
    phone varchar(15) NOT NULL,
    image varchar(255) DEFAULT '/asset/default-hospital.png',
    latitude float DEFAULT null,
    longitude float DEFAULT null
  );

create table
  blood_bank (
    name varchar(100) PRIMARY KEY,
    image varchar(255) DEFAULT '/asset/bloodbank.png',
    address varchar(255) NOT NULL,
    latitude float DEFAULT null,
    longitude float DEFAULT null
  );

create table
  blood_bag (
    id int PRIMARY KEY AUTO_INCREMENT,
    blood_group varchar(3) NOT NULL,
    date_taken date,
    date_collected date NOT NULL,
    quantity float DEFAULT 500,
    available varchar(1) NOT NULL,
    donar_id int NOT NULL,
    hospital_id int DEFAULT null,
    blood_bank_name varchar(50),
    Foreign key (donar_id) references user (id) ON DELETE CASCADE,
    Foreign key (hospital_id) references hospital (id),
    Foreign key (blood_bank_name) references blood_bank (name)
  );

create table
  hospital_contact (
    hospital_id int NOT NULL,
    address varchar(15) NOT NULL,
    medium varchar(15) NOT NULL,
    Foreign key (hospital_id) references hospital (id) ON DELETE CASCADE,
    PRIMARY key (hospital_id, address)
  );

Create table
  blood_bank_contact (
    blood_bank_name varchar(50) NOT NULL,
    address varchar(15) NOT NULL,
    medium varchar(15) NOT NULL,
    FOREIGN KEY (blood_bank_name) REFERENCES blood_bank (name) ON DELETE CASCADE,
    PRIMARY KEY (blood_bank_name, address)
  );
