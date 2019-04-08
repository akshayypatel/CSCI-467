<?php
	$dsn = "mysql:host=courses;dbname=z1785771";
	$username = "z1785771";
	$password = "1995Jan10";
	$pdo = new PDO($dsn, $username, $password);

	// This statement configures PDO to return database rows from your database using an associative
    // array.  This means the array will have string indexes, where the string value
    // represents the name of the column in your database.
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
?>