SET foreign_key_checks = 0;
DROP TABLE Account;
DROP TABLE Customers_Have_1;
DROP TABLE Customers_Have_2;
DROP TABLE Sellers;
DROP TABLE Products_Post;
DROP TABLE Purchase;
DROP TABLE Coupon;
DROP TABLE Warehouse;
DROP TABLE Uses;
DROP TABLE Store;
DROP TABLE Transfer_Station;
DROP TABLE Transfer_To;
DROP TABLE Ship_To;
DROP TABLE Delivery;
DROP TABLE Staff_2;
DROP TABLE Staff_1;
DROP TABLE Logistic_Staff;
DROP TABLE Customer_Service;
DROP TABLE Work_On;
DROP TABLE Help;
SET foreign_key_checks = 1;




CREATE TABLE Account(
    email_address VARCHAR(50),
    password VARCHAR(50) NOT NULL,
    PRIMARY KEY (email_address)
);

CREATE TABLE Customers_Have_1 (
    postal_code VARCHAR(50),
    province VARCHAR(50) NOT NULL ,
    city VARCHAR(50) NOT NULL ,

    PRIMARY KEY (postal_code)
);

CREATE TABLE Customers_Have_2 (
    ID VARCHAR(50),
    email_address VARCHAR(50) UNIQUE NOT NULL ,
    name VARCHAR(50) NOT NULL,
    postal_code VARCHAR(50),
    street_name VARCHAR(50),
    street_number VARCHAR(50),
    billing_info VARCHAR(50),

    PRIMARY KEY (ID),
    FOREIGN KEY (email_address) REFERENCES Account(email_address) ON DELETE CASCADE,
    FOREIGN KEY (postal_code) REFERENCES Customers_Have_1(postal_code) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Sellers (
    ID VARCHAR(50),
    name VARCHAR(50) NOT NULL,
    billing_info VARCHAR(50) NOT NULL ,
    email_address VARCHAR(50) UNIQUE NOT NULL ,

    PRIMARY KEY (ID),
    FOREIGN KEY (email_address) REFERENCES Account(email_address) ON DELETE CASCADE
);

CREATE TABLE Products_Post (
    product_ID VARCHAR(50),
    seller_ID VARCHAR(50),
    name VARCHAR(50) NOT NULL ,
    parcel_dimension VARCHAR(50) ,
    image BLOB,

    PRIMARY KEY (product_ID),
    FOREIGN KEY (seller_ID) REFERENCES Sellers(ID) ON DELETE CASCADE
);

CREATE TABLE Coupon (
    code VARCHAR(50),
    product_ID VARCHAR(50),
    expiry_date DATE NOT NULL ,
    amount DOUBLE NOT NULL ,

    PRIMARY KEY (code, product_ID),
    FOREIGN KEY (product_ID) REFERENCES Products_Post(product_ID) ON DELETE CASCADE
);

CREATE TABLE Purchase (
    customer_ID VARCHAR(50),
    product_ID VARCHAR(50),
    order_ID VARCHAR(50) UNIQUE NOT NULL ,

    PRIMARY KEY (customer_ID, product_ID),
    FOREIGN KEY (customer_ID) REFERENCES Customers_Have_2(ID) ON DELETE CASCADE
);

CREATE TABLE Warehouse (
    location VARCHAR(50),
    size INT NOT NULL ,
    current_usage INT ,

    PRIMARY KEY (location)
);

CREATE TABLE Uses (
    seller_ID VARCHAR(50),
    location VARCHAR(50),

    PRIMARY KEY (location, seller_ID),
    FOREIGN KEY (seller_ID) REFERENCES Sellers(ID) ON DELETE CASCADE,
    FOREIGN KEY (location) REFERENCES Warehouse(location) ON DELETE CASCADE
);

CREATE TABLE Store (
    product_ID VARCHAR(50),
    location VARCHAR(50),

    PRIMARY KEY (location, product_ID),
    FOREIGN KEY (product_ID) REFERENCES Products_Post(product_ID) ON DELETE CASCADE,
    FOREIGN KEY (location) REFERENCES Warehouse(location) ON DELETE CASCADE
);

CREATE TABLE Transfer_Station (
    location VARCHAR(50),
    size INT NOT NULL ,
    current_usage INT,

    PRIMARY KEY (location)
);

CREATE TABLE Transfer_To (
    warehouse_location VARCHAR(50),
    transfer_station_location VARCHAR(50),

    PRIMARY KEY (warehouse_location, transfer_station_location),
    FOREIGN KEY (warehouse_location) REFERENCES Warehouse(location) ON DELETE CASCADE,
    FOREIGN KEY (transfer_station_location) REFERENCES Transfer_Station(location) ON DELETE CASCADE
);

CREATE TABLE Ship_To (
    transfer_station_location_shipping VARCHAR(50),
    transfer_station_location_receiving VARCHAR(50),

    PRIMARY KEY (transfer_station_location_shipping, transfer_station_location_receiving),
    FOREIGN KEY (transfer_station_location_receiving) REFERENCES Transfer_Station(location) ON DELETE CASCADE,
    FOREIGN KEY (transfer_station_location_shipping) REFERENCES Transfer_Station(location) ON DELETE CASCADE
);

CREATE TABLE Delivery (
    transfer_station_location VARCHAR(50),
    customer_ID VARCHAR(50),

    PRIMARY KEY (transfer_station_location, customer_ID),
    FOREIGN KEY (transfer_station_location) REFERENCES Transfer_Station(location) ON DELETE CASCADE,
    FOREIGN KEY (customer_ID) REFERENCES Customers_Have_2(ID) ON DELETE CASCADE
);

CREATE TABLE Staff_1 (
    job_title VARCHAR(50),
    salary_rate INT NOT NULL ,

    PRIMARY KEY (job_title)
);

CREATE TABLE Staff_2 (
    employee_ID VARCHAR(50),
    job_title VARCHAR(50) NOT NULL ,
    name VARCHAR(50) NOT NULL ,
    email_address VARCHAR(50) UNIQUE NOT NULL ,


    PRIMARY KEY (employee_ID),
    FOREIGN KEY (job_title) REFERENCES Staff_1(job_title) ON DELETE CASCADE,
    FOREIGN KEY (email_address) REFERENCES Account(email_address) ON DELETE CASCADE

);

CREATE TABLE Logistic_Staff (
    employee_ID VARCHAR(50),
    region VARCHAR(50) NOT NULL ,

    PRIMARY KEY (employee_ID),
    FOREIGN KEY (employee_ID) REFERENCES Staff_2(employee_ID) ON DELETE CASCADE

);

CREATE TABLE Customer_Service (
    employee_ID VARCHAR(50),
    customer_satisfaction_rate DOUBLE ,

    PRIMARY KEY (employee_ID),
    FOREIGN KEY (employee_ID) REFERENCES Staff_2(employee_ID) ON DELETE CASCADE

);

CREATE TABLE Work_On (
    product_ID VARCHAR(50),
    warehouse_location VARCHAR(50),
    transfer_station_location VARCHAR(50),
    customer_ID VARCHAR(50),
    employee_ID VARCHAR(50),

    PRIMARY KEY (product_ID, warehouse_location, transfer_station_location, customer_ID, employee_ID),
    FOREIGN KEY (product_ID) REFERENCES Products_Post(product_ID) ON DELETE CASCADE,
    FOREIGN KEY (warehouse_location) REFERENCES Warehouse(location) ON DELETE CASCADE,
    FOREIGN KEY (transfer_station_location) REFERENCES Transfer_Station(location) ON DELETE CASCADE,
    FOREIGN KEY (customer_ID) REFERENCES Customers_Have_2(ID) ON DELETE CASCADE,
    FOREIGN KEY (employee_ID) REFERENCES Staff_2(employee_ID) ON DELETE CASCADE
);

CREATE TABLE Help (
    customer_ID VARCHAR(50),
    employee_ID VARCHAR(50),
    case_number VARCHAR(50) NOT NULL ,

    FOREIGN KEY (customer_ID) REFERENCES Customers_Have_2(ID) ON DELETE CASCADE,
    FOREIGN KEY (employee_ID) REFERENCES Staff_2(employee_ID) ON DELETE CASCADE
);



/*Account
(email address, password, prime_expires_in)
password, prime_expires_in: not null*/
INSERT INTO Account
VALUES ('ares@gmail.com', 'password');

INSERT INTO Account
VALUES ('zhangsan@163.com','88888888');

INSERT INTO Account
VALUES ('ding@126.com', '123456a');

INSERT INTO Account
VALUES ('enyo@gmail.com', 'citybuilder666');

INSERT INTO Account
VALUES ('artemis@qq.com','iloveares');

INSERT INTO Account
VALUES ('s1@gmail.com','123456');

INSERT INTO Account
VALUES ('s2@gmail.com','123456');

INSERT INTO Account
VALUES ('s3@gmail.com','123456');

INSERT INTO Account
VALUES ('s4@gmail.com','123456');

INSERT INTO Account
VALUES ('s5@gmail.com','123456');

INSERT INTO Account
VALUES ('e0@gmail.com','123456');

INSERT INTO Account
VALUES ('e1@gmail.com','123456');

INSERT INTO Account
VALUES ('e2@gmail.com','123456');

INSERT INTO Account
VALUES ('e3@gmail.com','123456');

INSERT INTO Account
VALUES ('e4@gmail.com','123456');

INSERT INTO Account
VALUES ('e5@gmail.com','123456');

INSERT INTO Account
VALUES ('e6@gmail.com','123456');

INSERT INTO Account
VALUES ('e7@gmail.com','123456');

INSERT INTO Account
VALUES ('e8@gmail.com','123456');

INSERT INTO Account
VALUES ('e9@gmail.com','123456');

INSERT INTO Account
VALUES ('e10@gmail.com','123456');



/*Customers_Have_1
(postal_code, province, city)
email_address, name: not null; email_address: unique*/
INSERT INTO Customers_Have_1
VALUES ('V6T 1Z4','BC','Vancouver');

INSERT INTO Customers_Have_1
VALUES ('V6T 1Z5','BC','Vancouver');

INSERT INTO Customers_Have_1
VALUES ('V6T 1Z6','BC','Vancouver');

INSERT INTO Customers_Have_1
VALUES ('V6T 1Z2', 'BC', 'Vancouver');

INSERT INTO Customers_Have_1
VALUES ('H3A 0C9', 'QC', 'Montreal');

/*
 Customers_Have_2 (ID, postal_code, email_address, name, billing_info, street_number, street_name)
 email_address, name: not null
 */

INSERT INTO Customers_Have_2
VALUES ('c1','ares@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

INSERT INTO Customers_Have_2
VALUES ('c2','zhangsan@163.com','Lucien Shi', 'V6T 1Z5', null, null, null);

INSERT INTO Customers_Have_2
VALUES ('c3','ding@126.com','Flora Niu', 'V6T 1Z6', null, null, '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

INSERT INTO Customers_Have_2
VALUES ('c4','enyo@gmail.com','Zheng Ying','V6T 1Z2', 'Mathematics Road','1984', '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

INSERT INTO Customers_Have_2
VALUES ('c5','artemis@qq.com','Youran Su', 'H3A 0C9', 'rue McTavish', '3459', null);


/*Purchase
(customer_ID, product_ID, order_ID)
order_ID: unique*/
INSERT INTO Purchase
VALUES ('c1','p1','o1');

INSERT INTO Purchase
VALUES ('c2','p2','o2');

INSERT INTO Purchase
VALUES ('c3','p3','o3');

INSERT INTO Purchase
VALUES ('c4','p4','o4');

INSERT INTO Purchase
VALUES ('c5','p5','o5');

/*Seller
(ID, name, billing_info)
name, billing_info: not null */
INSERT INTO Sellers
VALUES ('s1','Nox','2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's1@gmail.com');

INSERT INTO Sellers
VALUES ('s2','Mary Sue', '2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's2@gmail.com');

INSERT INTO Sellers
VALUES ('s3','Jack Sue', '1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 's3@gmail.com');

INSERT INTO Sellers
VALUES ('s4','Alpha Go', '345 rue McTavish, Montreal, QC, H3A 0C99', 's4@gmail.com');

INSERT INTO Sellers
VALUES ('s5','Luna Moon', '345 rue McTavish, Montreal, QC, H3A 0C99', 's5@gmail.com');

/*Products_Post
(product_ID, seller_ID, name, parcel_dimension)
name, storage: not null  */
INSERT INTO Products_Post
VALUES ('p1','s1','magic stick', '1*1*30', LOAD_FILE('./data/default_product.png'));

INSERT INTO Products_Post
VALUES ('p2','s2', 'teddy bear', '15*17*25', LOAD_FILE('./data/default_product.png'));

INSERT INTO Products_Post
VALUES ('p3','s3', 'hair band', null, LOAD_FILE('./data/default_product.png'));

INSERT INTO Products_Post
VALUES ('p4','s4', 'watermelon', '30*30*30', LOAD_FILE('./data/default_product.png'));

INSERT INTO Products_Post
VALUES ('p5','s5', 'regret medicine', '1*1*1', LOAD_FILE('./data/default_product.png'));

/*Coupon
(code, product_ID, expiry_date, amount)
expiry_date, amount: not null*/
INSERT INTO Coupon
VALUES ('cp1','p1','2021-12-31',0.5);

INSERT INTO Coupon
VALUES ('cp2','p2','2049-01-01',0.1);

INSERT INTO Coupon
VALUES ('cp3','p3','2022-01-13',0.99);

INSERT INTO Coupon
VALUES ('cp4','p4','2024-11-15',0.3);

INSERT INTO Coupon
VALUES ('cp5','p5','2021-12-01',0.01);


/*Warehouse
(location, size, current_usage)
size: not null */
INSERT INTO Warehouse
VALUES ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', 10000, 2);

INSERT INTO Warehouse
VALUES ('1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 500, 200);

INSERT INTO Warehouse
VALUES ('345 rue McTavish, Montreal, QC, H3A 0C99', 6000, 6000);

INSERT INTO Warehouse
VALUES ('1961 East Mall, Vancouver, BC Canada V6T 1Z1', 100, 15);

INSERT INTO Warehouse
VALUES ('272-6081 University, Vancouver, BC Canada V6T 1Z1', 999,998);

INSERT INTO Warehouse
VALUES ('2049 Mathematics Road, Vancouver, BC, V6T 1Z2', 5, null);

INSERT INTO Warehouse
VALUES ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2', 50, 0);


/*Use
(seller_ID, location) */
INSERT INTO Uses
VALUES ('s1', '272-6081 University, Vancouver, BC Canada V6T 1Z1');

INSERT INTO Uses
VALUES ('s1','1984 Mathematics Road, Vancouver, BC, V6T 1Z2');

INSERT INTO Uses
VALUES ('s2','345 rue McTavish, Montreal, QC, H3A 0C99');

INSERT INTO Uses
VALUES ('s3','345 rue McTavish, Montreal, QC, H3A 0C99');

INSERT INTO Uses
VALUES ('s4','2205 Lower Mall, Vancouver, BC, V6T 1Z4');

INSERT INTO Uses
VALUES ('s5','1961 East Mall, Vancouver, BC Canada V6T 1Z1');

/*Store
(product_ID, location) */
INSERT INTO Store
VALUES ('p1', '272-6081 University, Vancouver, BC Canada V6T 1Z1');

INSERT INTO Store
VALUES ('p2', '345 rue McTavish, Montreal, QC, H3A 0C99');

INSERT INTO Store
VALUES ('p3', '345 rue McTavish, Montreal, QC, H3A 0C99');

INSERT INTO Store
VALUES ('p4','2205 Lower Mall, Vancouver, BC, V6T 1Z4');

INSERT INTO Store
VALUES ('p5','1961 East Mall, Vancouver, BC Canada V6T 1Z1');

/*Transfer_Station
(location, size, current_usage)
size: not null*/
INSERT INTO Transfer_Station
VALUES ('2814 Royal Avenue, New Westminster BC, V3L 5H1', 500,498);

INSERT INTO Transfer_Station
VALUES ('3292 2nd Street, Lorette, MB, R0A 0Y0', 10, 0);

INSERT INTO Transfer_Station
VALUES ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', 100, 1);

INSERT INTO Transfer_Station
VALUES ('900 Carlson Road, Prince George, BC, V2L 5E5', 50, 49);

INSERT INTO Transfer_Station
VALUES ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 1000, null);

/*Transfer_To
(warehouse_location, transfer_station_location) */
INSERT INTO Transfer_To
VALUES ('272-6081 University, Vancouver, BC Canada V6T 1Z1', '900 Carlson Road, Prince George, BC, V2L 5E5');

INSERT INTO Transfer_To
VALUES ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', '900 Carlson Road, Prince George, BC, V2L 5E5');

INSERT INTO Transfer_To
VALUES ('345 rue McTavish, Montreal, QC, H3A 0C99', '2820 rue des Églises Est, Hudson, QC, J0P 1H0');

INSERT INTO Transfer_To
VALUES ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2','3687 Kinchant St, Chilliwack, BC, V2P 2S6');

INSERT INTO Transfer_To
VALUES ('345 rue McTavish, Montreal, QC, H3A 0C99', '3687 Kinchant St, Chilliwack, BC, V2P 2S6');



/*Ship_To
(transfer_station_location_shipping, transfer_station_location_receiving)
 */
INSERT INTO Ship_To
VALUES ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '2814 Royal Avenue, New Westminster BC, V3L 5H1');

INSERT INTO Ship_To
VALUES ('2814 Royal Avenue, New Westminster BC, V3L 5H1','3292 2nd Street, Lorette, MB, R0A 0Y0');

INSERT INTO Ship_To
VALUES ('900 Carlson Road, Prince George, BC, V2L 5E5','2814 Royal Avenue, New Westminster BC, V3L 5H1');

INSERT INTO Ship_To
VALUES ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '900 Carlson Road, Prince George, BC, V2L 5E5');

INSERT INTO Ship_To
VALUES ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', '3687 Kinchant St, Chilliwack, BC, V2P 2S6');



/*Delivery (transfer_station_location, customer_ID) */
INSERT INTO Delivery
VALUES ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c4');

INSERT INTO Delivery
VALUES ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c2');

INSERT INTO Delivery
VALUES ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c3');

INSERT INTO Delivery
VALUES ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c2');

INSERT INTO Delivery
VALUES ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c5');


/*Staff_1
  (job_title, salary_rate)
  salary_rate: not null
 */
INSERT INTO Staff_1
VALUES ('Warehouse Associate', 20);

INSERT INTO Staff_1
VALUES ('Transfer Station Associate', 21);

INSERT INTO Staff_1
VALUES ('delivery man', 22);

INSERT INTO Staff_1
VALUES ('delivery manager', 23);

INSERT INTO Staff_1
VALUES ('boss', 85);

INSERT INTO Staff_1
VALUES ('customer service worker', 18);


/*Staff_2
  (employee_ID, job_title, name).
  job_title, name: not null
*/
INSERT INTO Staff_2
VALUES ('e0','boss', 'Julius Caesar', 'e0@gmail.com');

INSERT INTO Staff_2
VALUES ('e1','Warehouse Associate', 'nox', 'e1@gmail.com');

INSERT INTO Staff_2
VALUES ('e2','delivery man', 'ares', 'e2@gmail.com');

INSERT INTO Staff_2
VALUES ('e3','delivery man', 'artemis', 'e3@gmail.com');

INSERT INTO Staff_2
VALUES ('e4','delivery man', 'eros', 'e4@gmail.com');

INSERT INTO Staff_2
VALUES ('e5','delivery manager', 'hades', 'e5@gmail.com');

INSERT INTO Staff_2
VALUES ('e6','customer service worker', 'Erebus Eos', 'e6@gmail.com');

INSERT INTO Staff_2
VALUES ('e7','customer service worker', 'Phoebe Althea', 'e7@gmail.com');

INSERT INTO Staff_2
VALUES ('e8','customer service worker', 'Linus Praxis', 'e8@gmail.com');

INSERT INTO Staff_2
VALUES ('e9','customer service worker', 'Phaedra Diomedes', 'e9@gmail.com');

INSERT INTO Staff_2
VALUES ('e10','customer service worker', 'Carme Demeter', 'e10@gmail.com');


/* Logistic_Staff (employee_ID, region)
   region: not null
 */

INSERT INTO Logistic_Staff
VALUES ('e1', 'Vancouver');

INSERT INTO Logistic_Staff
VALUES ('e2', 'Vancouver');

INSERT INTO Logistic_Staff
VALUES ('e3', 'Manitoba');

INSERT INTO Logistic_Staff
VALUES ('e4', 'Montreal');

INSERT INTO Logistic_Staff
VALUES ('e5', 'Montreal');


/* Customer_Service
   (employee_ID, customer_satisfaction_rate)
 */

INSERT INTO Customer_Service
VALUES ('e6', 0);

INSERT INTO Customer_Service
VALUES ('e7', 5);

INSERT INTO Customer_Service
VALUES ('e8', 2.5);

INSERT INTO Customer_Service
VALUES ('e9', 4.5);

INSERT INTO Customer_Service
VALUES ('e10', 1);


/*  Work_on
    (product_ID, warehouse_location, transfer_station_location, customer_ID, employee_ID)
*/

INSERT INTO Work_On
VALUES ('p1',
        '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
        '3292 2nd Street, Lorette, MB, R0A 0Y0',
        'c1',
        'e1'
);

INSERT INTO Work_On
VALUES ('p2',
        '1984 Mathematics Road, Vancouver, BC, V6T 1Z2',
        '2820 rue des Églises Est, Hudson, QC, J0P 1H0',
        'c2',
        'e2'
);
INSERT INTO Work_On
VALUES ('p3',
        '1961 East Mall, Vancouver, BC Canada V6T 1Z1',
        '900 Carlson Road, Prince George, BC, V2L 5E5',
        'c3',
        'e3'
);

INSERT INTO Work_On
VALUES ('p3',
        '4096 Mathematics Road, Vancouver, BC, V6T 1Z2',
        '2814 Royal Avenue, New Westminster BC, V3L 5H1',
        'c4',
        'e4'
);

INSERT INTO Work_On
VALUES ('p5',
        '2049 Mathematics Road, Vancouver, BC, V6T 1Z2',
        '2814 Royal Avenue, New Westminster BC, V3L 5H1',
        'c5',
        'e2'
);


/*  Help
    (customer_ID, employee_ID, case_number)
    case_number: not null
*/

INSERT INTO Help
VALUES ('c1', 'e6', 'C123');

INSERT INTO Help
VALUES ('c1', 'e7', 'C123');

INSERT INTO Help
VALUES ('c2', 'e8', 'C007');

INSERT INTO Help
VALUES ('c3', 'e9', 'C008');

INSERT INTO Help
VALUES ('c4', 'e9', 'C223');

