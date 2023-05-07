/* Admin */
INSERT INTO admin(,,email,password) VALUES ('EL-COMPANY EL-MASRIA','Letegara El Sayarat','admin@admin.com','123');
/* Customers */
INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100111','Ahmed','Hassan','ahmed@gmail.com','ahmed',21,'M','01010101010');
INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100121','Kiro','Gayed','kiro@gmail.com','kiro',21,'M','01010101011');
INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100311','Alaa','Hossam','alaa@gmail.com','alaa',21,'F','01010101012');
INSERT INTO users(ssn,fname,lname,email,password,age,gender,phone) VALUES ('30101100100141','Ahmed','Falah','falah@gmail.com','falah',21,'M','01010101013');

/* car */
INSERT INTO car(car_plate_id,brand_name,brand_model,color,year,office_name,location,price,Type,automatic,hourse_power) 
VALUES ('alex1234','BMW','320i','Blue',2014,'El-se7s ll-sayarat','Alexandria',150,'Sedan','A',140);

INSERT INTO car(car_plate_id,brand_name,brand_model,color,year,office_name,location,price,Type,automatic,hourse_power) 
VALUES ('usa2233','BMW','x6','Black',2020,'Agance El-Hag Sayed','Newyork',500,'SUV','A',150);

INSERT INTO car(car_plate_id,brand_name,brand_model,color,year,office_name,location,price,Type,automatic,hourse_power) 
VALUES ('Ger3461','Renuault','Logan','Red',2016,'Agance El-Nour','Germany',100,'Sedan','A',127);

INSERT INTO car(car_plate_id,brand_name,brand_model,color,year,office_name,location,price,Type,automatic,hourse_power) 
VALUES ('Aus4533','Opel','Corsa','White',2019,'Agance El-Nas','Austria',100,'Hatchback','A',130);

/* office*/
INSERT INTO office(office_name,location) VALUES ('El-se7s ll-sayarat','Alexandria');
INSERT INTO office(office_name,location) VALUES ('Agance El-Hag Sayed','Newyork');
INSERT INTO office(office_name,location) VALUES ('Agance El-Nour','Germany');
INSERT INTO office(office_name,location) VALUES ('Agance El-Nas','Austria');