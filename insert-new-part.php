<?php
	$dsn = "mysql:host=courses;dbname=z1785771";
	$username = "z1785771";
	$password = "1995Jan10";
	$pdo = new PDO($dsn, $username, $password);
				
	$results = $pdo->prepare("INSERT INTO inventory_part (partName, partDescription, quantity, listingPrice, manufacturer_name) VALUES (?, ?, ?, ?, ?);");
	if (isset($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ))
	{	
		$results->execute(array($_POST['part-name'], $_POST['part-description'], $_POST['quantity'], $_POST['listing-price'], $_POST['manufacturer'] ));
    }
    // Redirect to success page
	header("Location: successful.html");
?>
