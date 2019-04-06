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

CREATE TABLE inventory_part (
	partID INT(12) NOT NULL AUTO_INCREMENT,
	partName TEXT(50) NOT NULL,
	partDescription TEXT(150) NOT NULL,
	quantity INT(6) NOT NULL,
	listingPrice INT(6) NOT NULL,
	manufacturer_name TEXT(50) NOT NULL,
	comments TEXT(250) NOT NULL,
	PRIMARY KEY (partID)
);

ALTER TABLE inventory_part AUTO_INCREMENT = 1001;
