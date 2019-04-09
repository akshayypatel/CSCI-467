<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Parts</title>
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
        require ("../php-actions/connect.php");
        $query = $pdo->query("SELECT * FROM address");
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
                            <li><a class="gn-icon gn-icon-download" href="../pages/create-customer.html">Create New Customer</a></li>
                            <li><a class="gn-icon gn-icon-cog" href="../pages/create-part.php">Create New Part</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../pages/create-rfq.php">Request For Quote</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../pages/generate-rfq-report.php">Generate RFQ Report</a></li>
                            <li><a class="gn-icon gn-icon-help" href="customer-accounts.php">Customer Account Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="address.php">Address Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="inventory-parts.php">Inventory Parts Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="request-for-quote.php">RFQ Database</a></li>
                            <li><a class="gn-icon gn-icon-help" href="rfq-part-list.php">RFQ Parts List Database</a></li>
                        </ul>
                    </div><!-- /gn-scroller -->
                </nav>
            </li>
            <li><a href="../index.html">Home</a></li>
        </ul>

    </div>
    <div class="container-contact100">
        <div class="wrap-contact100 width90">   
            <span class="contact100-form-title">
                Address Database
            </span>

            <div class="wrap-input100 bg1">
                <table class="table">
                    <tr>
                        <th>Address ID</th>
                        <th>Customer ID</th>
                        <th>Address Type</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip Code</th>
                    </tr>
                    <?php
                        // Loop through the query results, outputing the options one by one
                        while($row = $query->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<tr>';
                            echo '<td>' .$row['addressID'].'</td>';
                            echo '<td>' .$row['customerID'].'</td>';
                            echo '<td>' .$row['addressType'].'</td>';
                            echo '<td>' .$row['street'].'</td>';
                            echo '<td>' .$row['city'].'</td>';
                            echo '<td>' .$row['state'].'</td>';
                            echo '<td>' .$row['zipCode'].'</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
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
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="../js/main.js"></script>
</body>

</html>