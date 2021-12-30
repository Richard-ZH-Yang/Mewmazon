
<<<<<<< HEAD
  <html>
    <head>
        <title>populate database</title>
    </head>

    <body>
        <h2>Reset</h2>
        <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

        <form method="POST" action="admin.php">
            <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
            <p><input type="submit" value="Reset" name="reset"></p>
        </form>

        <hr />

        <h2>Insert Values into DemoTable</h2>
        <form method="POST" action="admin.php"> <!--refresh page when submitted-->
            <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
            <input type="submit" value="Insert" name="insertSubmit"></p>
        </form>

        <hr />


        <?php
require ('dbUtilUBCServer.php');


        function handleResetRequest() {
            global $db_conn;
            // Drop old table
            executePlainSQL("DROP TABLE Account CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Customers_Have_1 CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Customers_Have_2 CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Sellers CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Products_Post CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Purchase CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Coupon CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Warehouse CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Uses CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Store CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Transfer_Station CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Transfer_To CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Ship_To CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Delivery CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Staff_2 CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Staff_1 CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Logistic_Staff CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Customer_Service CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Work_On CASCADE CONSTRAINTS");
            executePlainSQL("DROP TABLE Help CASCADE CONSTRAINTS");

            // Create new table
            echo "<br> creating new table <br>";
            
executePlainSQL("create table Account (
=======
<html>
<head>
    <title>populate database</title>
</head>

<body>
<h2>Reset</h2>
<p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

<form method="POST" action="admin.php">
    <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
    <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
    <p><input type="submit" value="Reset" name="reset"></p>
</form>

<hr />

<h2>Insert Values into DemoTable</h2>
<form method="POST" action="admin.php"> <!--refresh page when submitted-->
    <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
    <input type="submit" value="Insert" name="insertSubmit"></p>
</form>

<hr />


<?php
require ('dbUtilUBCServer.php');


function handleResetRequest() {
    global $db_conn;
    // Drop old table
    executePlainSQL("DROP TABLE Account CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Customers_Have_1 CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Customers_Have_2 CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Sellers CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Products_Post CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Purchase CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Coupon CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Warehouse CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Uses CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Store CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Transfer_Station CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Transfer_To CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Ship_To CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Delivery CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Staff_2 CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Staff_1 CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Logistic_Staff CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Customer_Service CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Work_On CASCADE CONSTRAINTS");
    executePlainSQL("DROP TABLE Help CASCADE CONSTRAINTS");

    // Create new table
    echo "<br> creating new table <br>";

    executePlainSQL("create table Account (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
    email_address char(50),
    password char(50) not null,
    primary key (email_address))");

<<<<<<< HEAD
executePlainSQL("create table Customers_Have_1 (
=======
    executePlainSQL("create table Customers_Have_1 (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
    postal_code char(50),
    province char(50)  null ,
    city char(50)  null ,
    primary key (postal_code))");

<<<<<<< HEAD
executePlainSQL("create table Customers_Have_2 (
=======
    executePlainSQL("create table Customers_Have_2 (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
    ID char(50),
    email_address char(50) unique not null ,
    name char(50) not null,
    postal_code char(50) null,
    street_name char(50) null,
    street_number char(50) null,
    billing_info char(50) null,
    primary key (ID),
    foreign key (email_address) references Account ON DELETE CASCADE,
    foreign key (postal_code) references Customers_Have_1 ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Sellers (
=======
    executePlainSQL("create table Sellers (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
ID char(50) null,
name char(50) not null,
billing_info char(50) not null ,
email_address char(50) unique not null ,
primary key (ID),
foreign key (email_address) references Account ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Products_Post (
=======
    executePlainSQL("create table Products_Post (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
 product_ID char(50),
 seller_ID char(50) not null,
 name char(50) not null ,
 parcel_dimension char(50) null,
 status char(50) not null,
 price char(50) not null,
 primary key (product_ID),
 foreign key (seller_ID) references Sellers ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Coupon (
=======
    executePlainSQL("create table Coupon (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
code char(50) null,
product_ID char(50) null,
expiry_date char(50) not null,
amount double precision not null,
primary key (code, product_ID),
foreign key (product_ID) references Products_Post ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Purchase (
=======
    executePlainSQL("create table Purchase (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
ID char(50) null,
product_ID char(50) null,
order_ID char(50) unique not null ,
primary key (ID, product_ID),
foreign key (ID) references Customers_Have_2 ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Warehouse (
=======
    executePlainSQL("create table Warehouse (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
warehouseLocation char(50) null,
warehouseSize INT not null ,
current_usage INT null,
primary key (warehouseLocation))");

<<<<<<< HEAD
executePlainSQL("create table Uses (
=======
    executePlainSQL("create table Uses (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
seller_ID char(50) null,
warehouseLocation char(50) null,
primary key (warehouseLocation, seller_ID),
foreign key (seller_ID) references Sellers ON DELETE CASCADE,
foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Store (
=======
    executePlainSQL("create table Store (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
product_ID char(50) null,
warehouseLocation char(50) null,
primary key (warehouseLocation, product_ID),
foreign key (product_ID) references Products_Post ON DELETE CASCADE,
foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Transfer_Station (
=======
    executePlainSQL("create table Transfer_Station (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
    transLocation char(50) null,
    warehouseSize INT not null ,
    current_usage INT null,
    primary key (transLocation))");

<<<<<<< HEAD
executePlainSQL("create table Transfer_To (
=======
    executePlainSQL("create table Transfer_To (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
warehouseLocation char(50) null,
transLocation char(50) null,
primary key (warehouseLocation, transLocation),
foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE,
foreign key (transLocation) references Transfer_Station ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Ship_To (
=======
    executePlainSQL("create table Ship_To (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
transfer_station_location_shipping char(50) null,
transfer_station_location_receiving char(50) null,
primary key (transfer_station_location_shipping, transfer_station_location_receiving),
foreign key (transfer_station_location_receiving) references Transfer_Station(transLocation) ON DELETE CASCADE,
foreign key (transfer_station_location_shipping) references Transfer_Station(transLocation) ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Delivery (
=======
    executePlainSQL("create table Delivery (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
transLocation char(50) null,
ID char(50) null,
primary key (transLocation, ID),
foreign key (transLocation) references Transfer_Station ON DELETE CASCADE,
foreign key (ID) references Customers_Have_2 ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Staff_1 (
=======
    executePlainSQL("create table Staff_1 (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
job_title char(50) null,
salary_rate INT not null ,
primary key (job_title))");

<<<<<<< HEAD
executePlainSQL("create table Staff_2 (
=======
    executePlainSQL("create table Staff_2 (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
employee_ID char(50) null,
job_title char(50) not null ,
name char(50) not null ,
email_address char(50) unique not null ,
primary key (employee_ID),
foreign key (job_title) references Staff_1 ON DELETE CASCADE,
foreign key (email_address) references Account ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Logistic_Staff (
=======
    executePlainSQL("create table Logistic_Staff (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
  employee_ID char(50) null,
  region char(50) not null ,
  primary key (employee_ID),
  foreign key (employee_ID) references Staff_2 ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Customer_Service (
=======
    executePlainSQL("create table Customer_Service (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
    employee_ID char(50) null,
    customer_satisfaction_rate double precision null,
    primary key (employee_ID),
    foreign key (employee_ID) references Staff_2 ON DELETE CASCADE)");

<<<<<<< HEAD
executePlainSQL("create table Work_On (
=======
    executePlainSQL("create table Work_On (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
product_ID char(50) null,
warehouseLocation char(50) null,
translocation char(50) null,
customer_ID char(50) null,
employee_ID char(50) null,
primary key (product_ID, warehouseLocation, translocation, customer_ID, employee_ID),
foreign key (product_ID) references Products_Post ON DELETE CASCADE,
foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE,
foreign key (translocation) references Transfer_Station ON DELETE CASCADE,
foreign key (customer_ID) references Customers_Have_2 ON DELETE CASCADE,
foreign key (employee_ID) references Staff_2 ON DELETE CASCADE)");


<<<<<<< HEAD
executePlainSQL("create table Help (
=======
    executePlainSQL("create table Help (
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
ID char(50) null,
employee_ID char(50) null,
case_number char(50) not null ,
foreign key (ID) references Customers_Have_2 ON DELETE CASCADE,
foreign key (employee_ID) references Staff_2 ON DELETE CASCADE)");

<<<<<<< HEAD
            OCICommit($db_conn);
        }

        function handleInsertRequest() {
            global $db_conn;

            // // Account(email_address, password)
            // executePlainSQL("insert into Account
            // values ('s1@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('s2gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('s3@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('s4@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('s5@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('s6@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c1@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c2@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c3@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c4@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c5@gmail.com','123')");
            // executePlainSQL("insert into Account
            // values ('c6@gmail.com','123')");
            
            // // Customer_Have_1
            // executePlainSQL("insert into Customers_Have_1
            // values ('V6T 1Z4','BC','Vancouver')");
            // executePlainSQL("insert into Customers_Have_2
            // values ('c1','c1@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            // executePlainSQL("insert into Customers_Have_2
            // values ('c2','c2@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            // executePlainSQL("insert into Customers_Have_2
            // values ('c3','c3@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");


            executePlainSQL("insert into Account
            values ('ares@gmail.com', 'password')");
            
            executePlainSQL("insert into Account
            values ('zhangsan@163.com','88888888')");
            
            executePlainSQL("insert into Account
            values ('ding@126.com', '123456a')");
            
            executePlainSQL("insert into Account
            values ('enyo@gmail.com', 'citybuilder666')");
            
            executePlainSQL("insert into Account
            values ('artemis@qq.com','iloveares')");
            
            
            
            executePlainSQL("insert into Account
            values ('c1@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('c2@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('c3@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('c4@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('c5@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('c6@gmail.com','123')");
            
            
            
            executePlainSQL("insert into Account
            values ('s1@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('s2@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('s3@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('s4@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('s5@gmail.com','123')");
            
            
            
            executePlainSQL("insert into Account
            values ('e0@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e1@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e2@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e3@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e4@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e5@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e6@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e7@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e8@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e9@gmail.com','123')");
            
            executePlainSQL("insert into Account
            values ('e10@gmail.com','123')");
            
            
            
            executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z4','BC','Vancouver')");
            
            executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z5','BC','Vancouver')");
            
            executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z6','BC','Vancouver')");
            
            executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z2','BC','Vancouver')");
            
            executePlainSQL("insert into Customers_Have_1
            values ('H3A 0C9', 'QC', 'Montreal')");
            
            
            
            executePlainSQL("insert into Customers_Have_2
            values ('c1','c1@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            
            executePlainSQL("insert into Customers_Have_2
            values ('c2','c2@gmail.com','Lucien Shi', 'V6T 1Z5', null, null, null)");
            
            executePlainSQL("insert into Customers_Have_2
            values ('c3','c3@gmail.com','Flora Niu', 'V6T 1Z6', null, null, '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            
            executePlainSQL("insert into Customers_Have_2
            values ('c4','c4@gmail.com','Zheng Ying','V6T 1Z2', 'Mathematics Road','1984', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            
            executePlainSQL("insert into Customers_Have_2
            values ('c5','c5@gmail.com','Youran Su', 'H3A 0C9', 'rue McTavish', '3459', null)");
            
            
            
            executePlainSQL("insert into Purchase
            values ('c1','p1','o1')");
            
            executePlainSQL("insert into Purchase
            values ('c2','p2','o2')");
            
            executePlainSQL("insert into Purchase
            values ('c3','p3','o3')");
            
            executePlainSQL("insert into Purchase
            values ('c4','p4','o4')");
            
            executePlainSQL("insert into Purchase
            values ('c5','p5','o5')");
            
            
            
            executePlainSQL("insert into Sellers
            values ('s1','Nox','2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's1@gmail.com')");
            
            executePlainSQL("insert into Sellers
            values ('s2','Mary Sue', '2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's2@gmail.com')");
            
            executePlainSQL("insert into Sellers
            values ('s3','Jack Sue', '1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 's3@gmail.com')");
            
            executePlainSQL("insert into Sellers
            values ('s4','Alpha Go', '345 rue McTavish, Montreal, QC, H3A 0C99', 's4@gmail.com')");
            
            executePlainSQL("insert into Sellers
            values ('s5','Luna Moon', '345 rue McTavish, Montreal, QC, H3A 0C99', 's5@gmail.com')");
            
            
            
            executePlainSQL("insert into Products_Post
            values ('p1','s1','magic stick', '1*1*30', 'AVAILABLE', 10)");
            
            executePlainSQL("insert into Products_Post
            values ('p2','s2', 'teddy bear', '15*17*25','AVAILABLE', 200)");
            
            executePlainSQL("insert into Products_Post
            values ('p3','s3', 'hair band', null,'AVAILABLE', 30)");
            
            executePlainSQL("insert into Products_Post
            values ('p4','s4', 'watermelon', '30*30*30','AVAILABLE', 40)");
            
            executePlainSQL("insert into Products_Post
            values ('p5','s5', 'regret medicine', '1*1*1', 'AVAILABLE',50)");

            executePlainSQL("insert into Products_Post
values ('p6','s1','magic stick', '1*1*30', 'AVAILABLE', 10)");

executePlainSQL("insert into Products_Post
values ('p7','s1','magic stick', '10*20*30', 'AVAILABLE', 30)");

executePlainSQL("insert into Products_Post
values ('p8','s1','magic stick', '5*2*30', 'AVAILABLE', 20)");

executePlainSQL("insert into Products_Post
values ('p9','s2', 'teddy bear', '15*17*25','AVAILABLE', 200)");

executePlainSQL("insert into Products_Post
values ('p10','s2', 'teddy bear', '1*1*2','AVAILABLE', 2)");

executePlainSQL("insert into Products_Post
values ('p11','s2', 'teddy bear', '5*7*5','AVAILABLE', 20)");

executePlainSQL("insert into Products_Post
values ('p12','s3', 'hair band', null,'AVAILABLE', 30)");

executePlainSQL("insert into Products_Post
values ('p13','s4', 'watermelon', '30*30*30','AVAILABLE', 40)");

executePlainSQL("insert into Products_Post
values ('p14','s5', 'regret medicine', '1*1*1', 'AVAILABLE',50)");

executePlainSQL("insert into Products_Post
values ('p15','s1','butter stick', '1*10*30', 'PROCESS', 22)");

executePlainSQL("insert into Products_Post
values ('p16','s5', 'bear', '15*2*25','PROCESS', 32)");

executePlainSQL("insert into Products_Post
values ('p17','s2', 'peach', null,'PROCESS', 12)");

executePlainSQL("insert into Products_Post
values ('p18','s4', 'banana', '30*3*3','PROCESS', 53)");

executePlainSQL("insert into Products_Post
values ('p19','s1', 'phone', '1*2*3', 'PROCESS',89)");

executePlainSQL("insert into Products_Post
values ('p20','s1','cup', '1*5*30', 'DELEVERED', 32)");

executePlainSQL("insert into Products_Post
values ('p21','s2', 'laptop', '1*17*25','DELEVERED', 31)");


            
            
            
            executePlainSQL("insert into Coupon
            values ('cp1','p1','2021-12-31',0.5)");
            
            executePlainSQL("insert into Coupon
            values ('cp2','p2','2049-01-01',0.1)");
            
            executePlainSQL("insert into Coupon
            values ('cp3','p3','2022-01-13',0.99)");
            
            executePlainSQL("insert into Coupon
            values ('cp4','p4','2024-11-15',0.3)");
            
            executePlainSQL("insert into Coupon
            values ('cp5','p5','2021-12-01',0.01)");
            
            
            
            executePlainSQL("insert into Warehouse
            values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', 10000, 2)");
            
            executePlainSQL("insert into Warehouse
            values ('1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 500, 200)");
            
            executePlainSQL("insert into Warehouse
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', 6000, 6000)");
            
            executePlainSQL("insert into Warehouse
            values ('1961 East Mall, Vancouver, BC Canada V6T 1Z1', 100, 15)");
            
            executePlainSQL("insert into Warehouse
            values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', 999,998)");
            
            executePlainSQL("insert into Warehouse
            values ('2049 Mathematics Road, Vancouver, BC, V6T 1Z2', 5, null)");
            
            executePlainSQL("insert into Warehouse
            values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2', 50, 0)");
            
            
            
            executePlainSQL("insert into Uses
            values ('s1', '272-6081 University, Vancouver, BC Canada V6T 1Z1')");
            
            executePlainSQL("insert into Uses
            values ('s1','1984 Mathematics Road, Vancouver, BC, V6T 1Z2')");
            
            executePlainSQL("insert into Uses
            values ('s2','345 rue McTavish, Montreal, QC, H3A 0C99')");
            
            executePlainSQL("insert into Uses
            values ('s3','345 rue McTavish, Montreal, QC, H3A 0C99')");
            
            executePlainSQL("insert into Uses
            values ('s4','2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            
            executePlainSQL("insert into Uses
            values ('s5','1961 East Mall, Vancouver, BC Canada V6T 1Z1')");
            
            
            
            executePlainSQL("insert into Store
            values ('p1', '272-6081 University, Vancouver, BC Canada V6T 1Z1')");
            
            executePlainSQL("insert into Store
            values ('p2', '345 rue McTavish, Montreal, QC, H3A 0C99')");
            
            executePlainSQL("insert into Store
            values ('p3', '345 rue McTavish, Montreal, QC, H3A 0C99')");
            
            executePlainSQL("insert into Store
            values ('p4','2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
            
            executePlainSQL("insert into Store
            values ('p5','1961 East Mall, Vancouver, BC Canada V6T 1Z1')");
            
            
            
            executePlainSQL("insert into Transfer_Station
            values ('2814 Royal Avenue, New Westminster BC, V3L 5H1', 500,498)");
            
            executePlainSQL("insert into Transfer_Station
            values ('3292 2nd Street, Lorette, MB, R0A 0Y0', 10, 0)");
            
            executePlainSQL("insert into Transfer_Station
            values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', 100, 1)");
            
            executePlainSQL("insert into Transfer_Station
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 50, 49)");
            
            executePlainSQL("insert into Transfer_Station
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 1000, null)");
            
            
            
            executePlainSQL("insert into Transfer_To
            values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', '900 Carlson Road, Prince George, BC, V2L 5E5')");
            
            executePlainSQL("insert into Transfer_To
            values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', '900 Carlson Road, Prince George, BC, V2L 5E5')");
            
            executePlainSQL("insert into Transfer_To
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', '2820 rue des Églises Est, Hudson, QC, J0P 1H0')");
            
            executePlainSQL("insert into Transfer_To
            values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2','3687 Kinchant St, Chilliwack, BC, V2P 2S6')");
            
            executePlainSQL("insert into Transfer_To
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', '3687 Kinchant St, Chilliwack, BC, V2P 2S6')");
            
            
            
            executePlainSQL("insert into Ship_To
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '2814 Royal Avenue, New Westminster BC, V3L 5H1')");
            
            executePlainSQL("insert into Ship_To
            values ('2814 Royal Avenue, New Westminster BC, V3L 5H1','3292 2nd Street, Lorette, MB, R0A 0Y0')");
            
            executePlainSQL("insert into Ship_To
            values ('900 Carlson Road, Prince George, BC, V2L 5E5','2814 Royal Avenue, New Westminster BC, V3L 5H1')");
            
            executePlainSQL("insert into Ship_To
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '900 Carlson Road, Prince George, BC, V2L 5E5')");
            
            executePlainSQL("insert into Ship_To
            values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', '3687 Kinchant St, Chilliwack, BC, V2P 2S6')");
            
            
            
            executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c4')");
            
            executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c2')");
            
            executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c3')");
            
            executePlainSQL("insert into Delivery
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c2')");
            
            executePlainSQL("insert into Delivery
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c5')");
            
            
            
            executePlainSQL("insert into Staff_1
            values ('Warehouse Associate', 20)");
            
            executePlainSQL("insert into Staff_1
            values ('Transfer Station Associate', 21)");
            
            executePlainSQL("insert into Staff_1
            values ('delivery man', 22)");
            
            executePlainSQL("insert into Staff_1
            values ('delivery manager', 23)");
            
            executePlainSQL("insert into Staff_1
            values ('boss', 85)");
            
            executePlainSQL("insert into Staff_1
            values ('customer service worker', 18)");
            
            
            
            executePlainSQL("insert into Staff_2
            values ('e0','boss', 'Julius Caesar', 'e0@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e1','Warehouse Associate', 'nox', 'e1@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e2','delivery man', 'ares', 'e2@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e3','delivery man', 'artemis', 'e3@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e4','delivery man', 'eros', 'e4@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e5','delivery manager', 'hades', 'e5@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e6','customer service worker', 'Erebus Eos', 'e6@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e7','customer service worker', 'Phoebe Althea', 'e7@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e8','customer service worker', 'Linus Praxis', 'e8@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e9','customer service worker', 'Phaedra Diomedes', 'e9@gmail.com')");
            
            executePlainSQL("insert into Staff_2
            values ('e10','customer service worker', 'Carme Demeter', 'e10@gmail.com')");
            
            
            
            executePlainSQL("insert into Logistic_Staff
            values ('e1', 'Vancouver')");
            
            executePlainSQL("insert into Logistic_Staff
            values ('e2', 'Vancouver')");
            
            executePlainSQL("insert into Logistic_Staff
            values ('e3', 'Manitoba')");
            
            executePlainSQL("insert into Logistic_Staff
            values ('e4', 'Montreal')");
            
            executePlainSQL("insert into Logistic_Staff
            values ('e5', 'Montreal')");
            
            
            executePlainSQL("insert into Customer_Service
            values ('e6', 0)");
            
            executePlainSQL("insert into Customer_Service
            values ('e7', 5)");
            
            executePlainSQL("insert into Customer_Service
            values ('e8', 2.5)");
            
            executePlainSQL("insert into Customer_Service
            values ('e9', 4.5)");
            
            executePlainSQL("insert into Customer_Service
            values ('e10', 1)");
            
            
            
            executePlainSQL("insert into Work_On
=======
    OCICommit($db_conn);
}

function handleInsertRequest() {
    global $db_conn;

    // // Account(email_address, password)
    // executePlainSQL("insert into Account
    // values ('s1@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('s2gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('s3@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('s4@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('s5@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('s6@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c1@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c2@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c3@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c4@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c5@gmail.com','123')");
    // executePlainSQL("insert into Account
    // values ('c6@gmail.com','123')");

    // // Customer_Have_1
    // executePlainSQL("insert into Customers_Have_1
    // values ('V6T 1Z4','BC','Vancouver')");
    // executePlainSQL("insert into Customers_Have_2
    // values ('c1','c1@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
    // executePlainSQL("insert into Customers_Have_2
    // values ('c2','c2@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");
    // executePlainSQL("insert into Customers_Have_2
    // values ('c3','c3@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");


    executePlainSQL("insert into Account
            values ('ares@gmail.com', 'password')");

    executePlainSQL("insert into Account
            values ('zhangsan@163.com','88888888')");

    executePlainSQL("insert into Account
            values ('ding@126.com', '123456a')");

    executePlainSQL("insert into Account
            values ('enyo@gmail.com', 'citybuilder666')");

    executePlainSQL("insert into Account
            values ('artemis@qq.com','iloveares')");



    executePlainSQL("insert into Account
            values ('c1@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('c2@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('c3@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('c4@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('c5@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('c6@gmail.com','123')");



    executePlainSQL("insert into Account
            values ('s1@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('s2@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('s3@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('s4@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('s5@gmail.com','123')");



    executePlainSQL("insert into Account
            values ('e0@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e1@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e2@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e3@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e4@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e5@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e6@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e7@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e8@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e9@gmail.com','123')");

    executePlainSQL("insert into Account
            values ('e10@gmail.com','123')");



    executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z4','BC','Vancouver')");

    executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z5','BC','Vancouver')");

    executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z6','BC','Vancouver')");

    executePlainSQL("insert into Customers_Have_1
            values ('V6T 1Z2','BC','Vancouver')");

    executePlainSQL("insert into Customers_Have_1
            values ('H3A 0C9', 'QC', 'Montreal')");



    executePlainSQL("insert into Customers_Have_2
            values ('c1','c1@gmail.com','Victor Lee','V6T 1Z4', 'Lower Mall', '2205', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");

    executePlainSQL("insert into Customers_Have_2
            values ('c2','c2@gmail.com','Lucien Shi', 'V6T 1Z5', null, null, null)");

    executePlainSQL("insert into Customers_Have_2
            values ('c3','c3@gmail.com','Flora Niu', 'V6T 1Z6', null, null, '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");

    executePlainSQL("insert into Customers_Have_2
            values ('c4','c4@gmail.com','Zheng Ying','V6T 1Z2', 'Mathematics Road','1984', '2205 Lower Mall, Vancouver, BC, V6T 1Z4')");

    executePlainSQL("insert into Customers_Have_2
            values ('c5','c5@gmail.com','Youran Su', 'H3A 0C9', 'rue McTavish', '3459', null)");



    executePlainSQL("insert into Purchase
            values ('c1','p1','o1')");

    executePlainSQL("insert into Purchase
            values ('c2','p2','o2')");

    executePlainSQL("insert into Purchase
            values ('c3','p3','o3')");

    executePlainSQL("insert into Purchase
            values ('c4','p4','o4')");

    executePlainSQL("insert into Purchase
            values ('c5','p5','o5')");



    executePlainSQL("insert into Sellers
            values ('s1','Nox','2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's1@gmail.com')");

    executePlainSQL("insert into Sellers
            values ('s2','Mary Sue', '2205 Lower Mall, Vancouver, BC, V6T 1Z4', 's2@gmail.com')");

    executePlainSQL("insert into Sellers
            values ('s3','Jack Sue', '1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 's3@gmail.com')");

    executePlainSQL("insert into Sellers
            values ('s4','Alpha Go', '345 rue McTavish, Montreal, QC, H3A 0C99', 's4@gmail.com')");

    executePlainSQL("insert into Sellers
            values ('s5','Luna Moon', '345 rue McTavish, Montreal, QC, H3A 0C99', 's5@gmail.com')");



    executePlainSQL("insert into Products_Post
            values ('p1','s1','magic stick', '1*1*30', 'AVAILABLE', 10)");

    executePlainSQL("insert into Products_Post
            values ('p2','s2', 'teddy bear', '15*17*25','AVAILABLE', 200)");

    executePlainSQL("insert into Products_Post
            values ('p3','s3', 'hair band', null,'AVAILABLE', 30)");

    executePlainSQL("insert into Products_Post
            values ('p4','s4', 'watermelon', '30*30*30','AVAILABLE', 40)");

    executePlainSQL("insert into Products_Post
            values ('p5','s5', 'regret medicine', '1*1*1', 'AVAILABLE',50)");



    executePlainSQL("insert into Coupon
            values ('cp1','p1','2021-12-31',0.5)");

    executePlainSQL("insert into Coupon
            values ('cp2','p2','2049-01-01',0.1)");

    executePlainSQL("insert into Coupon
            values ('cp3','p3','2022-01-13',0.99)");

    executePlainSQL("insert into Coupon
            values ('cp4','p4','2024-11-15',0.3)");

    executePlainSQL("insert into Coupon
            values ('cp5','p5','2021-12-01',0.01)");



    executePlainSQL("insert into Warehouse
            values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', 10000, 2)");

    executePlainSQL("insert into Warehouse
            values ('1984 Mathematics Road, Vancouver, BC, V6T 1Z2', 500, 200)");

    executePlainSQL("insert into Warehouse
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', 6000, 6000)");

    executePlainSQL("insert into Warehouse
            values ('1961 East Mall, Vancouver, BC Canada V6T 1Z1', 100, 15)");

    executePlainSQL("insert into Warehouse
            values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', 999,998)");

    executePlainSQL("insert into Warehouse
            values ('2049 Mathematics Road, Vancouver, BC, V6T 1Z2', 5, null)");

    executePlainSQL("insert into Warehouse
            values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2', 50, 0)");



    executePlainSQL("insert into Uses
            values ('s1', '272-6081 University, Vancouver, BC Canada V6T 1Z1')");

    executePlainSQL("insert into Uses
            values ('s1','1984 Mathematics Road, Vancouver, BC, V6T 1Z2')");

    executePlainSQL("insert into Uses
            values ('s2','345 rue McTavish, Montreal, QC, H3A 0C99')");

    executePlainSQL("insert into Uses
            values ('s3','345 rue McTavish, Montreal, QC, H3A 0C99')");

    executePlainSQL("insert into Uses
            values ('s4','2205 Lower Mall, Vancouver, BC, V6T 1Z4')");

    executePlainSQL("insert into Uses
            values ('s5','1961 East Mall, Vancouver, BC Canada V6T 1Z1')");



    executePlainSQL("insert into Store
            values ('p1', '272-6081 University, Vancouver, BC Canada V6T 1Z1')");

    executePlainSQL("insert into Store
            values ('p2', '345 rue McTavish, Montreal, QC, H3A 0C99')");

    executePlainSQL("insert into Store
            values ('p3', '345 rue McTavish, Montreal, QC, H3A 0C99')");

    executePlainSQL("insert into Store
            values ('p4','2205 Lower Mall, Vancouver, BC, V6T 1Z4')");

    executePlainSQL("insert into Store
            values ('p5','1961 East Mall, Vancouver, BC Canada V6T 1Z1')");



    executePlainSQL("insert into Transfer_Station
            values ('2814 Royal Avenue, New Westminster BC, V3L 5H1', 500,498)");

    executePlainSQL("insert into Transfer_Station
            values ('3292 2nd Street, Lorette, MB, R0A 0Y0', 10, 0)");

    executePlainSQL("insert into Transfer_Station
            values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', 100, 1)");

    executePlainSQL("insert into Transfer_Station
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 50, 49)");

    executePlainSQL("insert into Transfer_Station
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 1000, null)");



    executePlainSQL("insert into Transfer_To
            values ('272-6081 University, Vancouver, BC Canada V6T 1Z1', '900 Carlson Road, Prince George, BC, V2L 5E5')");

    executePlainSQL("insert into Transfer_To
            values ('2205 Lower Mall, Vancouver, BC, V6T 1Z4', '900 Carlson Road, Prince George, BC, V2L 5E5')");

    executePlainSQL("insert into Transfer_To
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', '2820 rue des Églises Est, Hudson, QC, J0P 1H0')");

    executePlainSQL("insert into Transfer_To
            values ('4096 Mathematics Road, Vancouver, BC, V6T 1Z2','3687 Kinchant St, Chilliwack, BC, V2P 2S6')");

    executePlainSQL("insert into Transfer_To
            values ('345 rue McTavish, Montreal, QC, H3A 0C99', '3687 Kinchant St, Chilliwack, BC, V2P 2S6')");



    executePlainSQL("insert into Ship_To
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '2814 Royal Avenue, New Westminster BC, V3L 5H1')");

    executePlainSQL("insert into Ship_To
            values ('2814 Royal Avenue, New Westminster BC, V3L 5H1','3292 2nd Street, Lorette, MB, R0A 0Y0')");

    executePlainSQL("insert into Ship_To
            values ('900 Carlson Road, Prince George, BC, V2L 5E5','2814 Royal Avenue, New Westminster BC, V3L 5H1')");

    executePlainSQL("insert into Ship_To
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', '900 Carlson Road, Prince George, BC, V2L 5E5')");

    executePlainSQL("insert into Ship_To
            values ('2820 rue des Églises Est, Hudson, QC, J0P 1H0', '3687 Kinchant St, Chilliwack, BC, V2P 2S6')");



    executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c4')");

    executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c2')");

    executePlainSQL("insert into Delivery
            values ('900 Carlson Road, Prince George, BC, V2L 5E5', 'c3')");

    executePlainSQL("insert into Delivery
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c2')");

    executePlainSQL("insert into Delivery
            values ('3687 Kinchant St, Chilliwack, BC, V2P 2S6', 'c5')");



    executePlainSQL("insert into Staff_1
            values ('Warehouse Associate', 20)");

    executePlainSQL("insert into Staff_1
            values ('Transfer Station Associate', 21)");

    executePlainSQL("insert into Staff_1
            values ('delivery man', 22)");

    executePlainSQL("insert into Staff_1
            values ('delivery manager', 23)");

    executePlainSQL("insert into Staff_1
            values ('boss', 85)");

    executePlainSQL("insert into Staff_1
            values ('customer service worker', 18)");



    executePlainSQL("insert into Staff_2
            values ('e0','boss', 'Julius Caesar', 'e0@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e1','Warehouse Associate', 'nox', 'e1@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e2','delivery man', 'ares', 'e2@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e3','delivery man', 'artemis', 'e3@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e4','delivery man', 'eros', 'e4@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e5','delivery manager', 'hades', 'e5@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e6','customer service worker', 'Erebus Eos', 'e6@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e7','customer service worker', 'Phoebe Althea', 'e7@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e8','customer service worker', 'Linus Praxis', 'e8@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e9','customer service worker', 'Phaedra Diomedes', 'e9@gmail.com')");

    executePlainSQL("insert into Staff_2
            values ('e10','customer service worker', 'Carme Demeter', 'e10@gmail.com')");



    executePlainSQL("insert into Logistic_Staff
            values ('e1', 'Vancouver')");

    executePlainSQL("insert into Logistic_Staff
            values ('e2', 'Vancouver')");

    executePlainSQL("insert into Logistic_Staff
            values ('e3', 'Manitoba')");

    executePlainSQL("insert into Logistic_Staff
            values ('e4', 'Montreal')");

    executePlainSQL("insert into Logistic_Staff
            values ('e5', 'Montreal')");


    executePlainSQL("insert into Customer_Service
            values ('e6', 0)");

    executePlainSQL("insert into Customer_Service
            values ('e7', 5)");

    executePlainSQL("insert into Customer_Service
            values ('e8', 2.5)");

    executePlainSQL("insert into Customer_Service
            values ('e9', 4.5)");

    executePlainSQL("insert into Customer_Service
            values ('e10', 1)");



    executePlainSQL("insert into Work_On
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
            values ('p1',
              '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
              '2814 Royal Avenue, New Westminster BC, V3L 5H1',
              'c1',
              'e1'
              )");
<<<<<<< HEAD
            
            executePlainSQL("insert into Work_On
=======

    executePlainSQL("insert into Work_On
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
            values ('p2',
              '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
              '2814 Royal Avenue, New Westminster BC, V3L 5H1',
              'c2',
              'e2'
              )");
<<<<<<< HEAD
            
            executePlainSQL("insert into Work_On
=======

    executePlainSQL("insert into Work_On
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
            values ('p3',
              '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
              '2814 Royal Avenue, New Westminster BC, V3L 5H1',
              'c3',
              'e3'
              )");
<<<<<<< HEAD
            
            executePlainSQL("insert into Work_On
=======

    executePlainSQL("insert into Work_On
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
            values ('p3',
              '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
              '2814 Royal Avenue, New Westminster BC, V3L 5H1',
              'c4',
              'e4'
              )");
<<<<<<< HEAD
            
            executePlainSQL("insert into Work_On
=======

    executePlainSQL("insert into Work_On
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
            values ('p5',
              '2205 Lower Mall, Vancouver, BC, V6T 1Z4',
              '2814 Royal Avenue, New Westminster BC, V3L 5H1',
              'c5',
              'e2'
              )");
<<<<<<< HEAD
            
            
            
            executePlainSQL("insert into Help
            values ('c1', 'e6', 'C123')");
            
            executePlainSQL("insert into Help
            values ('c1', 'e7', 'C123')");
            
            executePlainSQL("insert into Help
            values ('c2', 'e8', 'C007')");
            
            executePlainSQL("insert into Help
            values ('c3', 'e9', 'C008')");
            
            executePlainSQL("insert into Help
            values ('c4', 'e9', 'C223')");
            
=======



    executePlainSQL("insert into Help
            values ('c1', 'e6', 'C123')");

    executePlainSQL("insert into Help
            values ('c1', 'e7', 'C123')");

    executePlainSQL("insert into Help
            values ('c2', 'e8', 'C007')");

    executePlainSQL("insert into Help
            values ('c3', 'e9', 'C008')");

    executePlainSQL("insert into Help
            values ('c4', 'e9', 'C223')");
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a




<<<<<<< HEAD
            OCICommit($db_conn);
        }




        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
                    handleUpdateRequest();
                } else if (array_key_exists('insertQueryRequest', $_POST)) {
                    handleInsertRequest();
                }

                disconnectFromDB();
            }
        }

        // HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if(array_key_exists('displayTuples', $_GET)) {
                    handleDisplayRequest();
                }

                disconnectFromDB();
            }
        }

		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest'])) {
            handleGETRequest();
        } else if (isset($_GET['displayTupleRequest'])) {
            handleGETRequest();
        }
		?>
	</body>
=======

    OCICommit($db_conn);
}




// HANDLE ALL POST ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handlePOSTRequest() {
    if (connectToDB()) {
        if (array_key_exists('resetTablesRequest', $_POST)) {
            handleResetRequest();
        } else if (array_key_exists('updateQueryRequest', $_POST)) {
            handleUpdateRequest();
        } else if (array_key_exists('insertQueryRequest', $_POST)) {
            handleInsertRequest();
        }

        disconnectFromDB();
    }
}

// HANDLE ALL GET ROUTES
// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
function handleGETRequest() {
    if (connectToDB()) {
        if (array_key_exists('countTuples', $_GET)) {
            handleCountRequest();
        } else if(array_key_exists('displayTuples', $_GET)) {
            handleDisplayRequest();
        }

        disconnectFromDB();
    }
}

if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
    handlePOSTRequest();
} else if (isset($_GET['countTupleRequest'])) {
    handleGETRequest();
} else if (isset($_GET['displayTupleRequest'])) {
    handleGETRequest();
}
?>
</body>
>>>>>>> af09ac1bb97c7d08a79c29253b48d144a38eeb7a
</html>
