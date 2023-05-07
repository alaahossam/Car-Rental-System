CREATE DATABASE CAR_RENTAL;
CREATE TABLE users(
    ssn VARCHAR(14) PRIMARY KEY,
    fname VARCHAR(25),
    lname VARCHAR(25),
    email VARCHAR(50) unique,
    password VARCHAR(255),
    age int,
    gender CHAR(1),
    phone VARCHAR(15) unique
    );

CREATE TABLE car(
    car_plate_id VARCHAR(10) PRIMARY KEY,
    brand_name VARCHAR(30),
    brand_model VARCHAR(30),
    color VARCHAR(255),
    year int,
    office_id int,
    price   float,
    img   BLOB,
    Type VARCHAR(255),
    automatic CHAR(1),
    out_of_service CHAR(1) DEFAULT 0,
    hourse_power int
    ); 

CREATE TABLE car_status(
    car_plate_id VARCHAR(255),
    out_of_service_start_date date,
    out_of_service_end_date date,    
    PRIMARY KEY(car_plate_id,out_of_service_start_date,out_of_service_end_date)
    );

CREATE TABLE office(
    office_id int  AUTO_INCREMENT PRIMARY KEY,
    office_name VARCHAR(255),
    location VARCHAR(255)
);

CREATE TABLE reservation(
    reservation_id int AUTO_INCREMENT unique,
    reservation_date date,
    pick_up_date date,
    return_date date,
    car_plate_id VARCHAR(10),
    ssn VARCHAR(14),
    office_id int,
    payment char(1),
    paid_at date,
    PRIMARY KEY(car_plate_id,ssn,pick_up_date,return_date)
);

CREATE TABLE admin(
    fname VARCHAR(25),
    lname VARCHAR(25),
    email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255)
);

ALTER TABLE reservation ADD FOREIGN KEY (car_plate_id) REFERENCES car (car_plate_id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE reservation ADD FOREIGN KEY (ssn) REFERENCES users (ssn)ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE reservation ADD FOREIGN KEY (office_id) REFERENCES office (office_id)ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE car ADD FOREIGN KEY (office_id) REFERENCES office (office_id)ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE car_status ADD FOREIGN KEY (car_plate_id) REFERENCES car (car_plate_id)ON DELETE CASCADE ON UPDATE CASCADE;


