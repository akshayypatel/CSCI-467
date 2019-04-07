<?php
	$dsn = "mysql:host=courses;dbname=z1785771";
	$username = "z1785771";
	$password = "1995Jan10";
	$pdo = new PDO($dsn, $username, $password);
    
    // Insert new account
	$results = $pdo->prepare("INSERT INTO customer_account (companyName, quoteType, managerEmailAddress, managerPhoneNumber, password) VALUES (?, ?, ?, ?, ?);");
	if (isset($_POST['company-name'], $_POST['quote-type'] ))
	{	
        $date = date("h:i:sa");
		$results->execute(array("discoverrrrr", "auto", "gonzalo@gmail.com", "1234567890", $date ));
    }
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