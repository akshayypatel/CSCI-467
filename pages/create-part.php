<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Create New Part</title>
	<meta name="author-1" content="Akshay Patel">
	<meta name="author-2" content="Gonzalo Pantoja">
	<meta name="description" content="RFQ System for CSCI 467 at NIU">
	<meta name="keywords" content="CSCI467, NIU, RFQ-System">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="../css/create-customer.css" />
	<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../css/demo.css" />
	<link rel="stylesheet" type="text/css" href="../css/component.css" />
	<link rel="stylesheet" type="text/css" href="../css/create-part.css" />
	<script src="../js/modernizr.custom.js"></script>
	<script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>
	<?php
		require ("../php-actions/connect.php");
		$query = $pdo->query("SELECT partID FROM inventory_part WHERE partID = (SELECT MAX(partID) FROM inventory_part)");
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$partID = $row['partID'];
		$partID = $partID + 1;
	?>
</head>

<body>
	<div class="container">
		<ul id="gn-menu" class="gn-menu-main">
			<li class="gn-trigger">
				<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
				<nav class="gn-menu-wrapper">
					<div class="gn-scroller">
						<ul class="gn-menu">
							<li class="gn-search-item">
								<input placeholder="Search" type="search" class="gn-search">
								<a class="gn-icon gn-icon-search"><span>Search</span></a>
							</li>
							<li><a class="gn-icon gn-icon-download" href="create-customer.html">Create New Customer</a></li>
							<li><a class="gn-icon gn-icon-cog" href="create-part.php">Create New Part</a></li>
							<li><a class="gn-icon gn-icon-help" href="create-rfq.php">Create RFQ</a></li>
							<li><a class="gn-icon gn-icon-help" href="generate-rfq-report.php">Generate RFQ Report</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/customer-accounts.php">Customer Account Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/address.php">Address Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/inventory-parts.php">Inventory Parts Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/view-company-directory.php">View Company Directory</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/view-all-rfqs.php">View All RFQs</a></li>
                        </ul>
                    </div><!-- /gn-scroller -->
                </nav>
            </li>
            <li><a href="../index.html">Home</a></li>
        </ul>

	</div><!-- /container -->

	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="POST" action="../php-actions/insert-new-part.php">
				<span class="contact100-form-title">
					Create New Part
				</span>
				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Part Number:</span>
					<?php
						echo '<input class="input100" type="text" style="cursor: default;" name="name" value="'.$partID.'" readonly>';
				    ?>
					
				</div>

				<div class="w-full js-show-service rs1-wrap-input100">
					<svg id="barcode"></svg>
				</div>

				<div class="line-break">
					<span class="line-break-label">Part Information</span>
				</div>

				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Part Name</span>
					<input class="input100" type="text" maxlength="50" name="part-name" required placeholder="Enter Part Name">
				</div>

				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Part Quantity</span>
					<input class="input100" type="number" pattern="[0-9]{*}" name="quantity" required placeholder="Enter Part Quantity">
				</div>

				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Manufacturer</span>
					<input class="input100" type="text" name="manufacturer" maxlength="50" required placeholder="Enter Manufacturer">
				</div>

				<div class="wrap-input100 bg1 rs1-wrap-input100">
					<span class="label-input100">Listing Price ($USD)</span>
					<input class="input100" type="number" name="listing-price" pattern="[0-9]{6}" required placeholder="Enter Listing Price">
				</div>

				<div class="wrap-input100 bg1">
					<span class="label-input100">Part Description</span>
					<textarea class="input100" name="part-description" required placeholder="Enter Part Description"></textarea>
				</div>

				<div class="container-contact100-form-btn">
					<input type="reset" value="Cancel" class="contact100-form-btn">
					<input type="submit" value="Create" class="contact100-form-btn">
			
				</div>
			</form>
		</div>
	</div>

	<script src="../js/classie.js"></script>
	<script src="../js/gnmenu.js"></script>
	<script>
		new gnMenu(document.getElementById('gn-menu'));
		JsBarcode("#barcode", "123456", {
			format: "pharmacode",
			lineColor: "#000",
			width: 6,
			height: 60,
			displayValue: false,
			background: "transparent"
		});
	</script>
</body>

</html>