<?php
	require("connect.php");
				
	$results = $pdo->prepare("INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES (?, ?, ?, ?, ?);");
	if (isset($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ))
	{	
		$results->execute(array($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ));

		header("Location: ../pages/create-part.php");
    } else {
    	header("Location: ../pages/error.html");
    }
?>
