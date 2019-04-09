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

-- Query to view company reps
SELECT companyName, CONCAT(firstName, ' ', lastName) AS representative, email, username, password
FROM `customer_account`
INNER JOIN `customer_representative` ON `customer_account`.customerID = `customer_representative`.customerID;

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