/*
    Hopper/Turing command to open MariaDB:
    mysql -h courses -u z1785771 -p z1785771

    Password: 1995Jan10
*/

DROP TABLE IF EXISTS rfq_part_list;
DROP TABLE IF EXISTS request_for_quote;
DROP TABLE IF EXISTS inventory_part;
DROP TABLE IF EXISTS customer_representative;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS customer_account;

CREATE TABLE customer_account(
	customerID int(6) NOT NULL AUTO_INCREMENT,
	companyName TEXT(99) NOT NULL,
	quoteType TEXT(6) NOT NULL,
	managerEmailAddress TEXT(50) NOT NULL,
	managerPhoneNumber TEXT(12) NOT NULL,
	username TEXT(99) NOT NULL,
	password TEXT(99) NOT NULL,
	comments TEXT(300),
	PRIMARY KEY (customerID)
);

DESCRIBE customer_account;

-- +---------------------+----------+------+-----+---------+----------------+
-- | Field               | Type     | Null | Key | Default | Extra          |
-- +---------------------+----------+------+-----+---------+----------------+
-- | customerID          | int(6)   | NO   | PRI | NULL    | auto_increment |
-- | companyName         | tinytext | NO   |     | NULL    |                |
-- | quoteType           | tinytext | NO   |     | NULL    |                |
-- | managerEmailAddress | tinytext | NO   |     | NULL    |                |
-- | managerPhoneNumber  | tinytext | NO   |     | NULL    |                |
-- | username            | tinytext | NO   |     | NULL    |                |
-- | password            | tinytext | NO   |     | NULL    |                |
-- | comments            | text     | YES  |     | NULL    |                |
-- +---------------------+----------+------+-----+---------+----------------+


CREATE TABLE address(
	addressID int(6) NOT NULL AUTO_INCREMENT,
	customerID int(6) NOT NULL,
	addressType TEXT(8) NOT NULL,
	street TEXT(99) NOT NULL,
	city TEXT(30) NOT NULL,
	state TEXT(30) NOT NULL,
	zipCode TEXT(5) NOT NULL,
	PRIMARY KEY (addressID, customerID),
	FOREIGN KEY (customerID) REFERENCES customer_account(customerID)
);

DESCRIBE address;

-- +-------------+----------+------+-----+---------+----------------+
-- | Field       | Type     | Null | Key | Default | Extra          |
-- +-------------+----------+------+-----+---------+----------------+
-- | addressID   | int(6)   | NO   | PRI | NULL    | auto_increment |
-- | customerID  | int(6)   | NO   | PRI | NULL    |                |
-- | addressType | tinytext | NO   |     | NULL    |                |
-- | street      | tinytext | NO   |     | NULL    |                |
-- | city        | tinytext | NO   |     | NULL    |                |
-- | state       | tinytext | NO   |     | NULL    |                |
-- | zipCode     | tinytext | NO   |     | NULL    |                |
-- +-------------+----------+------+-----+---------+----------------+


CREATE TABLE customer_representative (
	repID INT(6) NOT NULL AUTO_INCREMENT,
	phoneNumber TEXT(12) NOT NULL,
	firstName TEXT(30) NOT NULL,
	lastName TEXT(30) NOT NULL,
	email TEXT(50) NOT NULL,
	customerID INT(6) NOT NULL,
	PRIMARY KEY (repID, customerID),
	FOREIGN KEY (customerID) REFERENCES customer_account(customerID)
);

DESCRIBE customer_representative;

-- +-------------+----------+------+-----+---------+----------------+
-- | Field       | Type     | Null | Key | Default | Extra          |
-- +-------------+----------+------+-----+---------+----------------+
-- | repID       | int(6)   | NO   | PRI | NULL    | auto_increment |
-- | phoneNumber | tinytext | NO   |     | NULL    |                |
-- | firstName   | tinytext | NO   |     | NULL    |                |
-- | lastName    | tinytext | NO   |     | NULL    |                |
-- | email       | tinytext | NO   |     | NULL    |                |
-- | customerID  | int(6)   | NO   | PRI | NULL    |                |
-- +-------------+----------+------+-----+---------+----------------+


CREATE TABLE inventory_part (
	partID INT(12) NOT NULL AUTO_INCREMENT,
	partName TEXT(50) NOT NULL,
	partDescription TEXT(150) NOT NULL,
	quantity INT(6) NOT NULL,
	listingPrice INT(6) NOT NULL,
	manufacturer_name TEXT(50) NOT NULL,
	PRIMARY KEY (partID)
);

ALTER TABLE inventory_part AUTO_INCREMENT = 1001;

DESCRIBE inventory_part;

-- +-------------------+----------+------+-----+---------+----------------+
-- | Field             | Type     | Null | Key | Default | Extra          |
-- +-------------------+----------+------+-----+---------+----------------+
-- | partID            | int(12)  | NO   | PRI | NULL    | auto_increment |
-- | partName          | tinytext | NO   |     | NULL    |                |
-- | partDescription   | tinytext | NO   |     | NULL    |                |
-- | quantity          | int(6)   | NO   |     | NULL    |                |
-- | listingPrice      | int(6)   | NO   |     | NULL    |                |
-- | manufacturer_name | tinytext | NO   |     | NULL    |                |
-- +-------------------+----------+------+-----+---------+----------------+


CREATE TABLE request_for_quote (
	rfqID INT(6) NOT NULL AUTO_INCREMENT,
	customerID INT(6) NOT NULL,
	dateGenerated DATE NOT NULL,
	PRIMARY KEY (rfqID, customerID),
	FOREIGN KEY (customerID) REFERENCES customer_account(customerID)
);

DESCRIBE request_for_quote;

-- +---------------+--------+------+-----+---------+----------------+
-- | Field         | Type   | Null | Key | Default | Extra          |
-- +---------------+--------+------+-----+---------+----------------+
-- | rfqID         | int(6) | NO   | PRI | NULL    | auto_increment |
-- | customerID    | int(6) | NO   | PRI | NULL    |                |
-- | dateGenerated | date   | NO   |     | NULL    |                |
-- +---------------+--------+------+-----+---------+----------------+


CREATE TABLE rfq_part_list (
	partListID INT(6) NOT NULL AUTO_INCREMENT,
	quantity INT(6) NOT NULL,
	requiredDate DATE NOT NULL,
	partID INT(12) NOT NULL,
	rfqID INT(6) NOT NULL,
	customerID INT(6) NOT NULL,
	PRIMARY KEY (partListID, partID, rfqID, customerID),
	FOREIGN KEY (partID) REFERENCES inventory_part(partID),
	FOREIGN KEY (rfqID) REFERENCES request_for_quote(rfqID),
	FOREIGN KEY (customerID) REFERENCES customer_account(customerID)
);

DESCRIBE rfq_part_list;

-- +--------------+---------+------+-----+---------+----------------+
-- | Field        | Type    | Null | Key | Default | Extra          |
-- +--------------+---------+------+-----+---------+----------------+
-- | partListID   | int(6)  | NO   | PRI | NULL    | auto_increment |
-- | quantity     | int(6)  | NO   |     | NULL    |                |
-- | requiredDate | date    | NO   |     | NULL    |                |
-- | partID       | int(12) | NO   | PRI | NULL    |                |
-- | rfqID        | int(6)  | NO   | PRI | NULL    |                |
-- | customerID   | int(6)  | NO   | PRI | NULL    |                |
-- +--------------+---------+------+-----+---------+----------------+


-- Insert Customer Accounts

INSERT INTO customer_account VALUES (1, "Facebook", "Auto", "apatel29@niu.edu", "815-754-8856", "MarkZuckerberg", "blueBook$blind-19", "");
INSERT INTO customer_account VALUES (2, "Microsoft", "Manual", "gpantoja@niu.edu", "815-312-5674", "BillieG", "uS0ft-$harvard!", "");
INSERT INTO customer_account VALUES (3, "Discover", "Auto", "gpantoja@niu.edu", "815-312-5674", "RogerHockchild", "#code_orange", "They have escalated the CS program at NIU");
INSERT INTO customer_account VALUES (4, "Apple", "Manual", "apatel29@niu.edu", "815-754-8856", "TimmieApp", "LookWithA#C2011", "Not Steve Jobs, but he's okay..");

-- Insert Address

INSERT INTO address VALUES (1, 1, "Billing", "1 Hacker Way", "Menlo Park", "CA", "94025");
INSERT INTO address VALUES (2, 1, "Shipping", "191 N. Wacker Drive", "Chicago", "IL", "60606");
INSERT INTO address VALUES (3, 2, "Billing", "One Microsoft Way", "Redmond", "WA", "98052");
INSERT INTO address VALUES (4, 2, "Shipping", "3025 Highland Parkway", "Downers Grove", "IL", "60515");
INSERT INTO address VALUES (5, 3, "Billing", "2500 Lake Cook Rd", "Riverwoods", "IL", "60015");
INSERT INTO address VALUES (6, 3, "Shipping", "217 Normal Rd", "Dekalv", "IL", "60115");
INSERT INTO address VALUES (7, 4, "Billing", "1 Infinite Loop", "Cupertino", "CA", "95014");
INSERT INTO address VALUES (8, 4, "Shipping", "1 Apple Park Way", "Cupertino", "CA", "95014");

-- Insert Part
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("i7 6700k CPU", "Core i7-6700K is a quad-core 64-bit x86 high-end performance desktop microprocessor. This processor is based on the Skylake microarchitecture and is fabricated on a 14 nm process. It has a base frequency of 4 GHz and a turbo boost of up to 4.2 GHz", 400, 400, "Intel");
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("16GB DDR4 Ram", "G.SKILL Ripjaws V Series 16GB (2 x 8GB) 288-Pin DDR4 SDRAM DDR4 2400 (PC4 19200) Desktop Memory Model F4-2400C15D-16GVR", 100, 90, "G.SKILL");
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("GTX 1080 Ti", "The GeForce GTX 1080 Ti is our flagship 10-series gaming GPU. This card is packed with extreme gaming horsepower, next-gen 11 Gbps GDDR5X memory, and a massive 11 GB frame buffer.", 50, 700, "Nvidia");
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("Radeon RX Vega 64 GPU", "AMD Radeon RX Vega 64 is a high-end desktop graphics card. It uses the Vega 10 chip and is the top model of the AMD desktop graphics cards (through 2018). It offers 64 CUs clocked at 1247 - 1546 MHz (Boost) and 8 GB HBM2 graphics memory.", 20, 659, "AMD");
