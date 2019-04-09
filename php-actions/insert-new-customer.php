<?php
	require("connect.php");

    // Insert new account
	$result = $pdo->prepare("INSERT INTO customer_account (companyName, quoteType, managerEmailAddress, managerPhoneNumber, username, password, comments) VALUES (?, ?, ?, ?, ?, ?, ?);");
	
	$managerEmailAddress = "apate29@niu.edu";
	$managerPhoneNumber = "8159314345";
	
	if (isset( $_POST['company-name'], $_POST['quote-type'], $_POST['comments']))
	{	
		$result->execute(array($_POST['company-name'], $_POST['quote-type'], $managerEmailAddress, $managerPhoneNumber, $_POST['username'], $_POST['password'], $_POST['comments']));
    } 
    else {
		header("Location: ../pages/error.html");
	}

	//insert billing address
	$result = $pdo->prepare("INSERT INTO address (customerID, addressType, street, city, state, zipCode) VALUES ((SELECT MAX(customerID) FROM customer_account), ?, ?, ?, ?, ?);");

	if (isset( $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip']))
	{	
		$result->execute(array("Billing", $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip'] ));

    } 
    else {
		header("Location: ../pages/error.html");
	}

	if (!isset($_POST['shipping']))
	{
		//insert shipping address
		$result = $pdo->prepare("INSERT INTO address (customerID, addressType, street, city, state, zipCode) VALUES ((SELECT MAX(customerID) FROM customer_account), ?, ?, ?, ?, ?);");

		if (isset( $_POST['shipping-street'], $_POST['shipping-city'], $_POST['shipping-state'], $_POST['shipping-zip']))
		{	
			$result->execute(array("Shipping", $_POST['shipping-street'], $_POST['shipping-city'], $_POST['shipping-state'], $_POST['shipping-zip'] ));
	    } 
	    else {
			header("Location: ../pages/error.html");
		}
	
	} else {

		$result = $pdo->prepare("INSERT INTO address (customerID, addressType, street, city, state, zipCode) VALUES ((SELECT MAX(customerID) FROM customer_account), ?, ?, ?, ?, ?);");

		if (isset( $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip']))
		{	
			$result->execute(array("Shipping", $_POST['billing-street'], $_POST['billing-city'], $_POST['billing-state'], $_POST['billing-zip'] ));

	    } 
	    else {
			header("Location: ../pages/error.html");
		}

	}

	//insert representative
	$result = $pdo->prepare("INSERT INTO customer_representative (phoneNumber, firstName, lastName, email, customerID) VALUES (?, ?, ?, ?,(SELECT MAX(customerID) FROM customer_account));");

	if (isset( $_POST['phone'], $_POST['representative-first-name'], $_POST['representative-last-name'], $_POST['email'] ))
	{	
		$result->execute(array( $_POST['phone'], $_POST['representative-first-name'], $_POST['representative-last-name'], $_POST['email'] ));
		header("Location: ../pages/create-customer.html");
    } 
    else {
		header("Location: ../pages/error.html");
	}

?>