<?php
	include('secret.php');		// Import sql credentials
	$pdo = new PDO($dsn, $username, $password);
	
	// Save current time as temp password
	$customer_password = date("h:i:sa");

    // Insert new account
	$result = $pdo->prepare("INSERT INTO customer_account (companyName, quoteType, managerEmailAddress, managerPhoneNumber, password, comments) VALUES (?, ?, ?, ?, ?, ?);");
	
	$managerEmailAddress = "apate29@niu.edu";
	$managerPhoneNumber = "8159314345";
	
	if (isset( $_POST['company-name'], $_POST['quote-type'], $_POST['comments']))
	{	
		$result->execute(array($_POST['company-name'], $_POST['quote-type'], $managerEmailAddress, $managerPhoneNumber, $customer_password, $_POST['comments']));
    } 
    else {
		header("Location: error.html");
	}

	//insert billing address
	$result = $pdo->prepare("INSERT INTO address (customerID, addressType, street, city, state, zipCode) VALUES ((SELECT MAX(customerID) FROM customer_account), ?, ?, ?, ?, ?);");

	if (isset( $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip']))
	{	
		$result->execute(array("Billing", $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip'] ));

    } 
    else {
		header("Location: error.html");
	}

	//insert shipping address
	$result = $pdo->prepare("INSERT INTO address (customerID, addressType, street, city, state, zipCode) VALUES ((SELECT MAX(customerID) FROM customer_account), ?, ?, ?, ?, ?);");

	if (isset( $_POST['shipping-street'], $_POST['shipping-city'], $_POST['shipping-state'], $_POST['shipping-zip']))
	{	
		$result->execute(array("Shipping", $_POST['shipping-street'], $_POST['shipping-city'], $_POST['shipping-state'], $_POST['shipping-zip'] ));
    } 
    else {
		header("Location: error.html");
	}

	//insert representative
	$result = $pdo->prepare("INSERT INTO customer_representative (phoneNumber, firstName, lastName, email, customerID) VALUES (?, ?, ?, ?,(SELECT MAX(customerID) FROM customer_account));");

	if (isset( $_POST['phone'], $_POST['representative-first-name'], $_POST['representative-last-name'], $_POST['email'] ))
	{	
		$result->execute(array( $_POST['phone'], $_POST['representative-first-name'], $_POST['representative-last-name'], $_POST['email'] ));
		header("Location: create-customer.html");
    } 
    else {
		header("Location: error.html");
	}

?>