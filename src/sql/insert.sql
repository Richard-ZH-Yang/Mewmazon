/*Account
(email address, password)
password, prime_expires_in: not null*/
insert into Account
values ('ares@gmail.com', 'password');

insert into Account
values ('zhangsan@163.com','88888888');

insert into Account
values ('ding@126.com', '123456a');

insert into Account
values ('enyo@gmail.com', 'citybuilder666');

insert into Account
values ('artemis@qq.com','iloveares');

insert into Account
values ('s1@gmail.com','123456');

insert into Account
values ('s2@gmail.com','123456');

insert into Account
values ('s3@gmail.com','123456');

insert into Account
values ('s4@gmail.com','123456');

insert into Account
values ('s5@gmail.com','123456');

insert into Account
values ('e0@gmail.com','123456');

insert into Account
values ('e1@gmail.com','123456');

insert into Account
values ('e2@gmail.com','123456');

insert into Account
values ('e3@gmail.com','123456');

insert into Account
values ('e4@gmail.com','123456');

insert into Account
values ('e5@gmail.com','123456');

insert into Account
values ('e6@gmail.com','123456');

insert into Account
values ('e7@gmail.com','123456');

insert into Account
values ('e8@gmail.com','123456');

insert into Account
values ('e9@gmail.com','123456');

insert into Account
values ('e10@gmail.com','123456');



/*Customers_Have_1
(postal_code, province, city)
email_address, name: not null; email_address: unique*/
insert into Customers_Have_1
values ('V6T 1Z4','BC','Vancouver');

insert into Customers_Have_1
values ('V6T 1Z5','BC','Vancouver');

insert into Customers_Have_1
values ('V6T 1Z6','BC','Vancouver');

insert into Customers_Have_1
values ('V6T 1Z2', 'BC', 'Vancouver');

insert into Customers_Have_1
values ('H3A 0C9', 'QC', 'Montreal');

/*
 Customers_Have_2 (ID, postal_code, email_address, name, billing_info, street_number, street_name)
 email_address, name: not null
 */

insert into Customers_Have_2
values ('c1','ares@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

insert into Customers_Have_2
values ('c2','zhangsan@163.com','Lucien Shi', 'V6T 1Z5', null, null, null);

insert into Customers_Have_2
values ('c3','ding@126.com','Flora Niu', 'V6T 1Z6', null, null, '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

insert into Customers_Have_2
values ('c4','enyo@gmail.com','Zheng Ying','V6T 1Z2', 'Mathematics Road','1984', '2205 Lower Mall, Vancouver, BC, V6T 1Z4');

insert into Customers_Have_2
values ('c5','artemis@qq.com','Youran Su', 'H3A 0C9', 'rue McTavish', '3459', null);


/*Purchase
(customer_ID, product_ID, order_ID)
order_ID: unique*/
insert into Purchase
values ('c1','p1','o1');

insert into Purchase
values ('c2','p2','o2');

insert into Purchase
values ('c3','p3','o3');

insert into Purchase
values ('c4','p4','o4');

insert into Purchase
values ('c5','p5','o5');

/*Seller
(ID, name, billing_info)
name, billing_info: not null */
insert into Sellers
values ('s1','Nox','2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's1@gmail.com');

insert into Sellers
values ('s2','Mary Sue', '2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's2@gmail.com');

insert into Sellers
values ('s3','Jack Sue', '1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 's3@gmail.com');

insert into Sellers
values ('s4','Alpha Go', '345 rue McTavish, Montreal, QC, H3A 0C99', 's4@gmail.com');

insert into Sellers
values ('s5','Luna Moon', '345 rue McTavish, Montreal, QC, H3A 0C99', 's5@gmail.com');

/*Products_Post
(product_ID, seller_ID, name, parcel_dimension, status, image)
name, storage: not null  */
insert into Products_Post
values ('p1','s1','magic stick', '1*1*30', 'AVAILABLE', 10);

insert into Products_Post
values ('p2','s2', 'teddy bear', '15*17*25','AVAILABLE', 200);

insert into Products_Post
values ('p3','s3', 'hair band', null,'AVAILABLE', 30);

insert into Products_Post
values ('p4','s4', 'watermelon', '30*30*30','AVAILABLE', 40);

insert into Products_Post
values ('p5','s5', 'regret medicine', '1*1*1', 'AVAILABLE',50);

/*Coupon
(code, product_ID, expiry_date, amount)
expiry_date, amount: not null*/
insert into Coupon
values ('cp1','p1','2021-12-31',0.5);

insert into Coupon
values ('cp2','p2','2049-01-01',0.1);

insert into Coupon
values ('cp3','p3','2022-01-13',0.99);

insert into Coupon
values ('cp4','p4','2024-11-15',0.3);

insert into Coupon
values ('cp5','p5','2021-12-01',0.01);


/*Warehouse
(location, warehouseSize, current_usage)
warehouseSize: not null */
insert into Warehouse
values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', 10000, 2);

insert into Warehouse
values ('1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 500, 200);

insert into Warehouse
values ('345 rue McTavish, Montreal, QC, H3A 0C99', 6000, 6000);

insert into Warehouse
values ('1961 East Mall, Vancouver, BC Canada V6T 1Z1', 100, 15);

insert into Warehouse
values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', 999,998);

insert into Warehouse
values ('2049 Mathematics Road, Vancouver, BC, V6T 1Z2', 5, null);

insert into Warehouse
values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2', 50, 0);


/*Use
(seller_ID, location) */
insert into Uses
values ('s1', '272-6081 University, Vancouver, BC Canada V6T 1Z1');

insert into Uses
values ('s1','1984 Mathematics Road, Vancouver, BC, V6T 1Z2');

insert into Uses
values ('s2','345 rue McTavish, Montreal, QC, H3A 0C99');

insert into Uses
values ('s3','345 rue McTavish, Montreal, QC, H3A 0C99');

insert into Uses
values ('s4','2205 Lower Mall, Vancouver, BC, V6T 1Z4');

insert into Uses
values ('s5','1961 East Mall, Vancouver, BC Canada V6T 1Z1');

/*Store
(product_ID, location) */
insert into Store
values ('p1', '272-6081 University, Vancouver, BC Canada V6T 1Z1');

insert into Store
values ('p2', '345 rue McTavish, Montreal, QC, H3A 0C99');

insert into Store
values ('p3', '345 rue McTavish, Montreal, QC, H3A 0C99');

insert into Store
values ('p4','2205 Lower Mall, Vancouver, BC, V6T 1Z4');

insert into Store
values ('p5','1961 East Mall, Vancouver, BC Canada V6T 1Z1');

/*Transfer_Station
(location, warehouseSize, current_usage)
warehouseSize: not null*/
insert into Transfer_Station
values ('2814 Royal Avenue, New Westminster BC, V3L 5H1', 500,498);

insert into Transfer_Station
values ('3292 2nd Street, Lorette, MB, R0A 0Y0', 10, 0);

insert into Transfer_Station
values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', 100, 1);

insert into Transfer_Station
values ('900 Carlson Road, Prince George, BC, V2L 5E5', 50, 49);

insert into Transfer_Station
values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 1000, null);

/*Transfer_To
(warehouse_location, transfer_station_location) */
insert into Transfer_To
values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', '900 Carlson Road, Prince George, BC, V2L 5E5');

insert into Transfer_To
values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', '900 Carlson Road, Prince George, BC, V2L 5E5');

insert into Transfer_To
values ('345 rue McTavish, Montreal, QC, H3A 0C99', '2820 rue des Églises Est, Hudson, QC, J0P 1H0');

insert into Transfer_To
values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2','3687 Kinchant St, Chilliwack, BC, V2P 2S6');

insert into Transfer_To
values ('345 rue McTavish, Montreal, QC, H3A 0C99', '3687 Kinchant St, Chilliwack, BC, V2P 2S6');



/*Ship_To
(transfer_station_location_shipping, transfer_station_location_receiving)
 */
insert into Ship_To
values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '2814 Royal Avenue, New Westminster BC, V3L 5H1');

insert into Ship_To
values ('2814 Royal Avenue, New Westminster BC, V3L 5H1','3292 2nd Street, Lorette, MB, R0A 0Y0');

insert into Ship_To
values ('900 Carlson Road, Prince George, BC, V2L 5E5','2814 Royal Avenue, New Westminster BC, V3L 5H1');

insert into Ship_To
values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '900 Carlson Road, Prince George, BC, V2L 5E5');

insert into Ship_To
values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', '3687 Kinchant St, Chilliwack, BC, V2P 2S6');



/*Delivery (transfer_station_location, customer_ID) */
insert into Delivery
values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c4');

insert into Delivery
values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c2');

insert into Delivery
values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c3');

insert into Delivery
values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c2');

insert into Delivery
values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c5');


/*Staff_1
  (job_title, salary_rate)
  salary_rate: not null
 */
insert into Staff_1
values ('Warehouse Associate', 20);

insert into Staff_1
values ('Transfer Station Associate', 21);

insert into Staff_1
values ('delivery man', 22);

insert into Staff_1
values ('delivery manager', 23);

insert into Staff_1
values ('boss', 85);

insert into Staff_1
values ('customer service worker', 18);


/*Staff_2
  (employee_ID, job_title, name).
  job_title, name: not null
*/
insert into Staff_2
values ('e0','boss', 'Julius Caesar', 'e0@gmail.com');

insert into Staff_2
values ('e1','Warehouse Associate', 'nox', 'e1@gmail.com');

insert into Staff_2
values ('e2','delivery man', 'ares', 'e2@gmail.com');

insert into Staff_2
values ('e3','delivery man', 'artemis', 'e3@gmail.com');

insert into Staff_2
values ('e4','delivery man', 'eros', 'e4@gmail.com');

insert into Staff_2
values ('e5','delivery manager', 'hades', 'e5@gmail.com');

insert into Staff_2
values ('e6','customer service worker', 'Erebus Eos', 'e6@gmail.com');

insert into Staff_2
values ('e7','customer service worker', 'Phoebe Althea', 'e7@gmail.com');

insert into Staff_2
values ('e8','customer service worker', 'Linus Praxis', 'e8@gmail.com');

insert into Staff_2
values ('e9','customer service worker', 'Phaedra Diomedes', 'e9@gmail.com');

insert into Staff_2
values ('e10','customer service worker', 'Carme Demeter', 'e10@gmail.com');


/* Logistic_Staff (employee_ID, region)
  region: not null
 */

insert into Logistic_Staff
values ('e1', 'Vancouver');

insert into Logistic_Staff
values ('e2', 'Vancouver');

insert into Logistic_Staff
values ('e3', 'Manitoba');

insert into Logistic_Staff
values ('e4', 'Montreal');

insert into Logistic_Staff
values ('e5', 'Montreal');


/* Customer_Service
  (employee_ID, customer_satisfaction_rate)
 */

insert into Customer_Service
values ('e6', 0);

insert into Customer_Service
values ('e7', 5);

insert into Customer_Service
values ('e8', 2.5);

insert into Customer_Service
values ('e9', 4.5);

insert into Customer_Service
values ('e10', 1);


/*  Work_on
  (product_ID, warehouse_location, transfer_station_location, customer_ID, employee_ID)
*/

insert into Work_On
values ('p1',
  '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
  '3292 2nd Street, Lorette, MB, R0A 0Y0',
  'c1',
  'e1'
  );

insert into Work_On
values ('p2',
  '1984 Mathematics Road, Vancouver, BC, V6T 1Z2',
  '2820 rue des Églises Est, Hudson, QC, J0P 1H0',
  'c2',
  'e2'
  );
insert into Work_On
values ('p3',
  '1961 East Mall, Vancouver, BC Canada V6T 1Z1',
  '900 Carlson Road, Prince George, BC, V2L 5E5',
  'c3',
  'e3'
  );

insert into Work_On
values ('p3',
  '4096 Mathematics Road, Vancouver, BC, V6T 1Z2',
  '2814 Royal Avenue, New Westminster BC, V3L 5H1',
  'c4',
  'e4'
  );

insert into Work_On
values ('p5',
  '2049 Mathematics Road, Vancouver, BC, V6T 1Z2',
  '2814 Royal Avenue, New Westminster BC, V3L 5H1',
  'c5',
  'e2'
  );


/*  Help
  (customer_ID, employee_ID, case_number)
  case_number: not null
*/

insert into Help
values ('c1', 'e6', 'C123');

insert into Help
values ('c1', 'e7', 'C123');

insert into Help
values ('c2', 'e8', 'C007');

insert into Help
values ('c3', 'e9', 'C008');

insert into Help
values ('c4', 'e9', 'C223');

