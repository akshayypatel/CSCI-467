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
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("GTX 1080 Ti", "The GeForce® GTX 1080 Ti is our flagship 10-series gaming GPU. This card is packed with extreme gaming horsepower, next-gen 11 Gbps GDDR5X memory, and a massive 11 GB frame buffer.", 50, 700, "Nvidia");
INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES ("Radeon RX Vega 64 GPU", "AMD Radeon RX Vega 64 is a high-end desktop graphics card. It uses the Vega 10 chip and is the top model of the AMD desktop graphics cards (through 2018). It offers 64 CUs clocked at 1247 - 1546 MHz (Boost) and 8 GB HBM2 graphics memory.", 20, 659, "AMD");

-- Query to view company reps
SELECT companyName, CONCAT(firstName, ' ', lastName) AS representative, email, username, password
FROM `customer_account`
INNER JOIN `customer_representative` ON `customer_account`.customerID = `customer_representative`.customerID;

-- Query to find Company Name and Date Generated by RFQID
SELECT companyName, dateGenerated
FROM `customer_account`
INNER JOIN `request_for_quote` ON `customer_account`.customerID = `request_for_quote`.customerID;

-- Query to view parts requested by a company
SELECT rfq.rfqID, companyName, partName, pl.quantity, requiredDate
FROM rfq_part_list pl
INNER JOIN request_for_quote rfq ON pl.rfqID = rfq.rfqID
INNER JOIN customer_account ca ON rfq.customerID = ca.customerID
INNER JOIN inventory_part ip ON pl.partID = ip.partID
ORDER BY rfq.rfqID;

-- Query to view company address and contact person
SELECT companyName, CONCAT(addressType, ': ', street, ', ', city, ', ', state, ' ', zipCode) AS address, CONCAT(firstName, ' ', lastName) AS representative, email
FROM `customer_account`
INNER JOIN `customer_representative` ON `customer_account`.customerID = `customer_representative`.customerID
INNER JOIN `address` ON `customer_account`.customerID = `address`.customerID;

-- Query for Generated RFQ Report
SELECT rfq.rfqID, ca.companyName, ip.partID, ip.partName, ip.partDescription, pl.quantity, ip.listingPrice, pl.requiredDate, rfq.dateGenerated
FROM rfq_part_list pl
INNER JOIN request_for_quote rfq ON pl.rfqID = rfq.rfqID
INNER JOIN customer_account ca ON rfq.customerID = ca.customerID
INNER JOIN inventory_part ip ON pl.partID = ip.partID
WHERE rfq.dateGenerated BETWEEN ? AND ?
ORDER BY rfq.rfqID;