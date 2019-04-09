<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create RFQ</title>
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
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
    <link rel="stylesheet" type="text/css" href="../css/create-rfq.css" />
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
    <?php
        if ($_GET['numberOfParts'])
        {
            $loopUntil = intval($_GET['numberOfParts']);
        } else {
            $loopUntil = 0;
        }
        
		require ("../php-actions/connect.php");
		$query = $pdo->query("SELECT rfqID FROM request_for_quote WHERE rfqID = (SELECT MAX(rfqID) FROM request_for_quote)");
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$rfqID = $row['rfqID'];
		$rfqID = $rfqID + 1;
	?>
</head>

<body>
    <!-- Nav -->
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
                            <li><a class="gn-icon gn-icon-help" href="../database/request-for-quote.php">RFQ Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/rfq-part-list.php">RFQ Parts List Database</a></li>
                        </ul>
                    </div><!-- /gn-scroller -->
                </nav>
            </li>
            <li><a href="../index.html">Home</a></li>
        </ul>

    </div>

    <div class="container-contact100">
        <?php
            if($loopUntil < 1)
            {
                echo '<div class="wrap-contact100 noMarginTop">';
            } else {
                echo '<div class="wrap-contact100">';
            }

            echo '<form class="contact100-form validate-form" method="POST" action="../php-actions/insert-new-rfq.php?loopUntil='; echo $loopUntil; echo '">';
                
            ?>

                <span class="contact100-form-title">
                    Create Request For Quote
                </span>
                <?php

                if ($loopUntil > 0) {
                    echo '<div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                    <span class="label-input100">RFQ ID</span>
                    <input class="input100" type="button" style="cursor: default;" name="rfqID" value="';

                    echo $rfqID;

                    echo ' " readonly>
                    </div>

                    <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                        <span class="label-input100">Quote Type</span>
                        <input class="input100" type="button" style="cursor: default;" value="AUTO">
                    </div>

                    <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                        <span class="label-input100">Customer ID: Company</span>
                        <div>
                            <select class="js-select2" required name="customerID">';

                                $query = $pdo->query("SELECT companyName, customerID FROM customer_account");
                                echo '<option disabled selected>Select Company</option>';
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    echo '<option value="'.$row['customerID'].'" > ' . $row['customerID'] . ' : ' . $row['companyName'] .'</option>';
                                }

                    echo '</select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>';

                }

                ?>

                <div class="line-break">
                    <span class="line-break-label">Part Information</span>
                </div>

                <?php    

                    for($i=1; $i<=$loopUntil; $i++) {
                        echo '<div class="wrap-input100 justifyContent">
                            <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250 inline-block">
                                <span class="label-input100">Part</span>
                                <div>
                                    <select class="js-select2" required name="part'; echo $i; echo 'id">';
                                        $query = $pdo->query("SELECT partName, partID, manufacturer_name, listingPrice FROM inventory_part");
                                        echo '<option disabled selected>Select Part</option>';
                                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
                                        {
                                            echo '<option value="'.$row['partID'].'" > ' . $row['manufacturer_name'] . ' : ' . $row['partName'] .' : $' . $row['listingPrice'] .'</option>';
                                        }
                                        
                                    echo '</select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                            </div>

                            <div class="wrap-input100 bg1 rs1-wrap-input100 w250 inline-block">
                                <span class="label-input100">Quantity</span>
                                <input class="input100" required type="number" name="part'; echo $i; echo 'quantity" placeholder="Enter Quantity">
                            </div>

                            <div class="wrap-input100 bg1 rs1-wrap-input100 w250 inline-block">
                                <span class="label-input100">Required Date</span>
                                <div class="form-row show-inputbtns">
                                    <input type="date" required data-date-inline-picker="false" data-date-open-on-focus="true" name="part'; echo $i; echo 'date"/>
                                </div>
                            </div>
                        </div>';
                    }

                    if ($loopUntil >= 1) {
                        echo '<div class="container-contact100-form-btn">
                            <input class="contact100-form-btn" onClick="window.location=\'create-rfq.php\'" type="button" value="Cancel">
                            <input type="submit" class="contact100-form-btn" value="Request">
                        </div>';
                    }
                ?>
            </form>
            <?php
                if ($loopUntil < 1)
                {
                    echo '<form class="contact100-form validate-form" method="GET" action="create-rfq.php">
                        <div class="wrap-input100 bg1">
                            <span class="label-input100">How many parts do you want to add?</span>
                            <div class = "flexbox">
                                <input class="input100 inputResized" type="number" name="numberOfParts" placeholder="Enter Number">
                                <button class="contact100-form-btn noMarginRight" onClick="create-rfq.php">Insert Parts</button>
                            </div>
                        </div>
                    </form>';
                }  
            ?>
        </div>
    </div>

    
    <!-- Scripts -->
    <script src="../js/classie.js"></script>
    <script src="../js/gnmenu.js"></script>
    <script>
        new gnMenu(document.getElementById('gn-menu'));
    </script>
    <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function(){
            $(this).select2({
                minimumResultsForSearch: 2,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!-- <script>
        var index = 0;
        function duplicate() {
            $("#part1").clone().attr('id', 'part1' + index).appendTo("#parts");
            $("#part2").clone().attr('id', 'part2' + index).appendTo("#parts");
            $("#part3").clone().attr('id', 'part3' + index).appendTo("#parts");
            index++;
        };
    </script> -->
    <script src="../js/main.js"></script>
</body>

</html>