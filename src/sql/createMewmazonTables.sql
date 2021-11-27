create table Account
(
    email_address char(50),
    password char(50) not null,
    primary key (email_address));

grant select on Account to public;

create table Customers_Have_1 (
                                  postal_code char(50),
                                  province char(50)  null ,
                                  city char(50)  null ,
                                  primary key (postal_code));

grant select on Customers_Have_1 to public;

create table Customers_Have_2 (
                                  ID char(50),
                                  email_address char(50) unique not null ,
                                  name char(50) not null,
                                  postal_code char(50) null,
                                  street_name char(50) null,
                                  street_number char(50) null,
                                  billing_info char(50) null,
                                  primary key (ID),
                                  foreign key (email_address) references Account ON DELETE CASCADE,
                                  foreign key (postal_code) references Customers_Have_1 ON DELETE CASCADE);

grant select on Customers_Have_2 to public;

create table Sellers (
                         ID char(50) null,
                         name char(50) not null,
                         billing_info char(50) not null ,
                         email_address char(50) unique not null ,
                         primary key (ID),
                         foreign key (email_address) references Account ON DELETE CASCADE);



create table Products_Post (
                               product_ID char(50),
                               seller_ID char(50),
                               name char(50) not null ,
                               parcel_dimension char(50) null,
                               image BLOB null,
                               primary key (product_ID),
                               foreign key (seller_ID) references Sellers ON DELETE CASCADE);

grant select on Sellers to public;

create table Coupon (
                        code char(50) null,
                        product_ID char(50) null,
                        expiry_date DATE not null,
                        amount double precision not null,
                        primary key (code, product_ID),
                        foreign key (product_ID) references Products_Post ON DELETE CASCADE);

grant select on Sellers to public;

create table Purchase (
                          ID char(50) null,
                          product_ID char(50) null,
                          order_ID char(50) unique not null ,
                          primary key (ID, product_ID),
                          foreign key (ID) references Customers_Have_2 ON DELETE CASCADE);

grant select on Sellers to public;

create table Warehouse (
                           warehouseLocation char(50) null,
                           warehouseSize INT not null ,
                           current_usage INT null,
                           primary key (warehouseLocation));

grant select on Sellers to public;

create table Uses (
                      seller_ID char(50) null,
                      warehouseLocation char(50) null,
                      primary key (warehouseLocation, seller_ID),
                      foreign key (seller_ID) references Sellers ON DELETE CASCADE,
                      foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE);

grant select on Sellers to public;

create table Store (
                       product_ID char(50) null,
                       warehouseLocation char(50) null,
                       primary key (warehouseLocation, product_ID),
                       foreign key (product_ID) references Products_Post ON DELETE CASCADE,
                       foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE);

grant select on Sellers to public;

create table Transfer_Station (
                                  transLocation char(50) null,
                                  warehouseSize INT not null ,
                                  current_usage INT null,
                                  primary key (transLocation));

grant select on Transfer_Station to public;

create table Transfer_To (
                             warehouseLocation char(50) null,
                             transLocation char(50) null,
                             primary key (warehouseLocation, transLocation),
                             foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE,
                             foreign key (transLocation) references Transfer_Station ON DELETE CASCADE);

grant select on Transfer_To to public;

create table Ship_To (
                         transfer_station_location_shipping char(50) null,
                         transfer_station_location_receiving char(50) null,
                         primary key (transfer_station_location_shipping, transfer_station_location_receiving),
                         foreign key (transfer_station_location_receiving) references Transfer_Station(transLocation) ON DELETE CASCADE,
                         foreign key (transfer_station_location_shipping) references Transfer_Station(transLocation) ON DELETE CASCADE);

grant select on Ship_To to public;

create table Delivery (
                          transLocation char(50) null,
                          ID char(50) null,
                          primary key (transLocation, ID),
                          foreign key (transLocation) references Transfer_Station ON DELETE CASCADE,
                          foreign key (ID) references Customers_Have_2 ON DELETE CASCADE);

grant select on Delivery to public;

create table Staff_1 (
                         job_title char(50) null,
                         salary_rate INT not null ,
                         primary key (job_title));

grant select on Staff_1 to public;

create table Staff_2 (
                         employee_ID char(50) null,
                         job_title char(50) not null ,
                         name char(50) not null ,
                         email_address char(50) unique not null ,
                         primary key (employee_ID),
                         foreign key (job_title) references Staff_1 ON DELETE CASCADE,
                         foreign key (email_address) references Account ON DELETE CASCADE);

grant select on Staff_2 to public;

create table Logistic_Staff (
                                employee_ID char(50) null,
                                region char(50) not null ,
                                primary key (employee_ID),
                                foreign key (employee_ID) references Staff_2 ON DELETE CASCADE);

grant select on Logistic_Staff to public;

create table Customer_Service (
                                  employee_ID char(50) null,
                                  customer_satisfaction_rate double precision null,
                                  primary key (employee_ID),
                                  foreign key (employee_ID) references Staff_2 ON DELETE CASCADE);

grant select on Customer_Service to public;

create table Work_On (
                         ID char(50) null,
                         warehouseLocation char(50) null,
                         translocation char(50) null,
                         product_ID char(50) null,
                         employee_ID char(50) null,
                         primary key (product_ID, warehouseLocation, translocation, ID, employee_ID),
                         foreign key (product_ID) references Products_Post ON DELETE CASCADE,
                         foreign key (warehouseLocation) references Warehouse ON DELETE CASCADE,
                         foreign key (translocation) references Transfer_Station ON DELETE CASCADE,
                         foreign key (ID) references Customers_Have_2 ON DELETE CASCADE,
                         foreign key (employee_ID) references Staff_2 ON DELETE CASCADE);

grant select on Work_On to public;

create table Help (
                      ID char(50) null,
                      employee_ID char(50) null,
                      case_number char(50) not null ,
                      foreign key (ID) references Customers_Have_2 ON DELETE CASCADE,
                      foreign key (employee_ID) references Staff_2 ON DELETE CASCADE);

grant select on Help to public;
