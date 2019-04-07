/*
    Hopper/Turing command to open MariaDB:
    mysql -h courses -u z1785771 -p z1785771

    Password: 1995Jan10
*/

CREATE TABLE customer_account(
	customerID int(6) NOT NULL AUTO_INCREMENT,
	companyName TEXT(99) NOT NULL,
	quoteType TEXT(6) NOT NULL,
	managerEmailAddress TEXT(50) NOT NULL,
	managerPhoneNumber TEXT(12) NOT NULL,
	password TEXT(99) NOT NULL,
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
-- | password            | tinytext | NO   |     | NULL    |                |
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
	FOREIGN KEY (customerID) REFERENCES customer_account(customerID));
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


INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("testing part one", "just a test", 10, 2, "Amazon");