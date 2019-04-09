<?php
	$loopUntil = $_GET['loopUntil'];

	require("connect.php");
				
	$results = $pdo->prepare("INSERT INTO request_for_quote (customerID, dateGenerated) VALUES (?, now());");
	if (isset($_POST['customerID']))
	{	
		$customerID = $_POST['customerID'];
		$results->execute(array($_POST['customerID']));
    } else {
    	header("Location: ../pages/error.html");
    }

    if(isset($_POST['part1id'], $_POST['part1quantity'], $_POST['part1date']))
    {
    	$query = $pdo->query("SELECT rfqID FROM request_for_quote WHERE rfqID = (SELECT MAX(rfqID) FROM request_for_quote)");
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$rfqID = $row['rfqID'];

    	for($i=1; $i<=$loopUntil; $i++) {
	    	$results = $pdo->prepare("INSERT INTO rfq_part_list (partID, quantity, requiredDate, customerID, rfqID) VALUES (?, ?, ?, ?, ?);");

	    	if (isset($_POST['part'.$i.'id'], $_POST['part'.$i.'quantity'], $_POST['part'.$i.'date']))
			{	
				$results->execute(array($_POST['part'.$i.'id'], $_POST['part'.$i.'quantity'], $_POST['part'.$i.'date'], $customerID, $rfqID));
				header("Location: ../pages/create-rfq.php");
		    } else {
		    	header("Location: ../pages/error.html");
		    }
    	}
    }

?>