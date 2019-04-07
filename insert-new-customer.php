<?php
	include('secret.php');		// Import sql credentials
	$pdo = new PDO($dsn, $username, $password);
	
	// Save current time
	$date = date("h:i:sa");
    // Insert new account
	$results = $pdo->prepare("INSERT INTO customer_account (companyName, quoteType, managerEmailAddress, managerPhoneNumber, password) VALUES (?, ?, ?, ?, ?);");
	if (isset( $_POST['company-name'], $_POST['quote-type']))
	{	
		$results->execute(array($_POST['company-name'], "auto", "gonzalo@gmail.com", "1234567890", $date ));
    } else {
		header("Location: error.html");
	}

	// select * from customer_account where password = "10:16:25pm";
	// $results = $pdo->prepare("SELECT customerID FROM customer_account WHERE password = ?");
	// $results->execute(array($date));


    // insert new address
    // $results = $pdo->prepare("INSERT INTO customer_account (companyName, quoteType, managerEmailAddress, managerPhoneNumber, password) VALUES (?, ?, ?, ?, ?);");
	// if (isset($_POST['company-name'], $_POST['quote-type'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ))
	// {	
    //     $date = date("h:i:sa");
	// 	$results->execute(array($_POST['company-name'], $_POST['quote-type'], "gonzalo@gmail.com", "1234567890", $date ));
    // }
    // Redirect to success page
	header("Location: part-created.html");
?>