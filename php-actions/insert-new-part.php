<?php
	// Start the session
	session_start();
	// Connect to database
	require("connect.php");
				
	$results = $pdo->prepare("INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES (?, ?, ?, ?, ?);");
	if (isset($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ))
	{	
		$results->execute(array($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ));

		$_SESSION["TITLE"] = "Part created";
		$_SESSION["REDIRECT-NAME"] = "Create New Part Page";
		$_SESSION["REDIRECT"] = "create-part";
		header("Location: ../pages/successful.php");
    } else {
		$_SESSION["TITLE"] = "Part creation failed";
		$_SESSION["REDIRECT-NAME"] = "Create New Part Page";
		$_SESSION["REDIRECT"] = "create-part";
    	header("Location: ../pages/error.php");
    }
?>
