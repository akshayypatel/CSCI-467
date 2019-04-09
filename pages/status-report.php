<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate RFQ Report</title>
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
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
    <?php
        require("../php-actions/connect.php");
        
        if ( $_POST['all-or-find'] == "all") 
        {
            $rfqResult = $pdo->prepare("SELECT rfq.rfqID, ca.companyName, ip.partID, ip.partName, ip.partDescription, pl.quantity, ip.listingPrice, pl.requiredDate, rfq.dateGenerated
            FROM rfq_part_list pl
            INNER JOIN request_for_quote rfq ON pl.rfqID = rfq.rfqID
            INNER JOIN customer_account ca ON rfq.customerID = ca.customerID
            INNER JOIN inventory_part ip ON pl.partID = ip.partID
            WHERE rfq.dateGenerated BETWEEN ? AND ?
            ORDER BY rfq.rfqID");
            $rfqResult->execute(array( $_POST['from-date'], $_POST['to-date']));
        } else {
            // If find
            $rfqResult = $pdo->prepare("SELECT rfq.rfqID, ca.companyName, ip.partID, ip.partName, ip.partDescription, pl.quantity, ip.listingPrice, pl.requiredDate, rfq.dateGenerated
            FROM rfq_part_list pl
            INNER JOIN request_for_quote rfq ON pl.rfqID = rfq.rfqID
            INNER JOIN customer_account ca ON rfq.customerID = ca.customerID
            INNER JOIN inventory_part ip ON pl.partID = ip.partID
            WHERE rfq.rfqID = ?
            ORDER BY rfq.rfqID");
            $rfqResult->execute(array( $_POST['rfqID'] ));   

            $query = $pdo->prepare("SELECT companyName, dateGenerated FROM `customer_account` INNER JOIN `request_for_quote` ON `customer_account`.customerID = `request_for_quote`.customerID WHERE rfqID = ?");
            $query->execute(array($_POST['rfqID']));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $cName = $row['companyName'];  
            $dGenerated =  $row['dateGenerated'];                              
        }

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
        <div class="wrap-contact100">
            <form class="contact100-form validate-form">
                
                <span class="contact100-form-title">
                    Generate RFQ Report
                </span>
                    <?php 
                        if ( $_POST['all-or-find'] != "all"){
                            echo '<div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                        <span class="label-input100">RFQ ID</span> 
                        <input class="input100" type="button" style="cursor: default;" value="'.$_POST['rfqID'].'"> 
                    </div>';

                    echo '<div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                        <span class="label-input100">Company Name</span> 
                        <input class="input100" type="button" style="cursor: default;" value="'.$cName.'"> 
                    </div>';

                    echo '<div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                        <span class="label-input100">Date Generated</span> 
                        <input class="input100" type="button" style="cursor: default;" value="'.$dGenerated.'"> 
                    </div>';

                        }
                    ?>

                    <div class="line-break center">
                        <span class="line-break-label">Part Information</span>
                    </div>

                    <div class="wrap-input100 bg1">
                    <table class="table">
                        <?php
                            echo '<tr>';
                            if ($_POST['report-type'] == "detail")
                            {
                                if (isset( $_POST['company-name'] ) && $_POST['all-or-find'] != "all") 
                                {
                                    echo "<th>Company Name</th>";
                                }
                                if (isset($_POST['part-name']))
                                {
                                    echo '<th>Part Name</th>';
                                }
                                if (isset( $_POST['part-description'] )) 
                                {
                                    echo '<th>Description</th>';
                                } 
                                if (isset( $_POST['part-price'] )) 
                                {
                                    echo '<th>Price</th>';
                                }
                                if (isset( $_POST['part-quantity'] )) 
                                { 
                                    echo '<th>Quantity</th>';
                                }
                                if (isset( $_POST['date-required'] )) 
                                {
                                    echo "<th>Required Date</th>";
                                }
                                if (isset( $_POST['date-generated']) && $_POST['all-or-find'] == "all") 
                                {
                                    echo "<th>Date Generated</th>";
                                }
                            } else {
                                if ( $_POST['all-or-find'] == "all") {
                                    echo '<th>Company Name</th>';
                                }
                                // If summary report type is selected
                                echo '<th>Part Name</th>';
                                echo '<th>Quantity</th>';
                                echo '<th>Price</th>';
                                echo "<th>Required Date</th>";
                            }
                            echo '</tr>';

                            while($row = $rfqResult->fetch(PDO::FETCH_ASSOC))
                            {
                                echo '<tr>';
                                if ($_POST['report-type'] == "detail")
                                {
                                    if (isset( $_POST['company-name']) && $_POST['all-or-find'] != "all") 
                                    {
                                        echo '<td>' .$row['companyName'].'</td>';
                                    }
                                    if (isset($_POST['part-name']))
                                    {
                                        echo '<td>' .$row['partName'].'</td>';
                                    }
                                    if (isset( $_POST['part-description'] )) 
                                    {
                                        echo '<td>' .$row['partDescription'].'</td>';
                                    } 
                                    if (isset( $_POST['part-price'] )) 
                                    {
                                        echo '<td>' .$row['listingPrice'].'</td>';
                                    }
                                    if (isset( $_POST['part-quantity'] )) 
                                    { 
                                        echo '<td>' .$row['quantity'].'</td>';
                                    }
                                    if (isset( $_POST['date-required'] )) 
                                    {
                                        echo '<td>' .$row['requiredDate'].'</td>';
                                    }
                                    if (isset( $_POST['date-generated']) && $_POST['all-or-find'] == "all") 
                                    {
                                        echo '<td>' .$row['dateGenerated'].'</td>';
                                    }
                                } else {
                                    if ( $_POST['all-or-find'] == "all") {
                                        echo '<td>' .$row['companyName'].'</td>';
                                    }
                                    echo '<td>' .$row['partName'].'</td>';
                                    echo '<td>' .$row['quantity'].'</td>';
                                    echo '<td>' .$row['listingPrice'].'</td>';
                                    echo '<td>' .$row['requiredDate'].'</td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </table>
                    </div>
                </form>
            </div>
        </div>
    ?>

    
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
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="../js/main.js"></script>
</body>

</html>