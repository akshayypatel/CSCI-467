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