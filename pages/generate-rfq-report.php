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
        require ("../php-actions/connect.php");
        $query = $pdo->query("SELECT rfqID, customerID FROM request_for_quote");
        $customerID = 0;
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
                            <li><a class="gn-icon gn-icon-help" href="../database/view-company-directory.php">View Company Directory</a></li>
                            <li><a class="gn-icon gn-icon-help" href="../database/view-all-rfqs.php">View All RFQs</a></li>
                        </ul>
                    </div><!-- /gn-scroller -->
                </nav>
            </li>
            <li><a href="../index.html">Home</a></li>
        </ul>

    </div>

    <div class="container-contact100">
        <div class="wrap-contact100">
            <form class="contact100-form validate-form" action="status-report.php" method="POST">
                
                <span class="contact100-form-title">
                    Generate RFQ Report
                </span>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250 height100">
                    <span class="label-input100">RFQ ID</span>
                    <select class="js-select2" onchange="yesnoCheck(this);" name="all-or-find">
                        <option value="all">All</option>
                        <option value="find">Find RFQ</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>

                <div id="replaceMe" class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250 height100">
                    <div id="dates">
                        <span class="label-input100">From</span>
                        <div class="form-row show-inputbtns">
                            <input type="date" class="dateStyle" required data-date-inline-picker="false" data-date-open-on-focus="true" name="from-date" id="from-date"/>
                        </div>
                        <span class="label-input100">To</span>
                        <div class="form-row show-inputbtns">
                            <input type="date" class="dateStyle" required data-date-inline-picker="false" data-date-open-on-focus="true" name="to-date" id="to-date"/>
                        </div>
                    </div>  

                    <div id="ifYes" style="display: none;">
                        <select class="js-select2" name="rfqID">
                            <?php
                                echo '<option disabled selected>Select RFQ ID</option>';
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) 
                                {
                                    echo '<option value="'.$row['rfqID'].'" > ' . $row['rfqID'] . '</option>';
                                }
                            ?>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250 height100">
                    <span class="label-input100">Report Type</span>
                    <select class="js-select2" onchange="reportType(this);" name="report-type">
                        <option value="summary">Summary</option>
                        <option value="detail">Detail</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>

                <div id="show-detail" style="display: none;">
                    <div class="line-break center">
                        <span class="line-break-label">Report Type</span>
                    </div>

                    <div class="contact100-form bg1">
                        

                        <div class="line-break center">
                            <span class="line-break-label">Columns to be included</span>
                        </div>

                        <div class="wrap-input100 bg1 rs1-wrap-input100 checkboxes noBorder">
                            <input type="checkbox" id="part-name" name="part-name">
                            <label class="line-break-label" for="part-name">Part Name</label>
                            <br>
                            <input type="checkbox" id="part-description" name="part-description">
                            <label class="line-break-label" for="part-description">Part Description</label>
                            <br>
                            <input type="checkbox" id="part-price" name="part-price">
                            <label class="line-break-label" for="part-price">Part Price</label>
                            <br>
                            <input type="checkbox" id="part-quantity" name="part-quantity">
                            <label class="line-break-label" for="part-quantity">Quantity Requested</label>
                        </div>

                        <div class="wrap-input100 bg1 rs1-wrap-input100 checkboxes noBorder">
                            <input type="checkbox" id="company-name" name="company-name">
                            <label class="line-break-label" for="company-name">Company Name</label>
                            <br>
                            <input type="checkbox" id="need-rfq" name="need-rfq">
                            <label class="line-break-label" for="need-rfq">RFQ ID</label>
                            <br>
                            <input type="checkbox" id="date-required" name="date-required">
                            <label class="line-break-label" for="date-required">Date Required</label>
                            <br>
                            <input type="checkbox" id="date-generated" name="date-generated">
                            <label class="line-break-label" for="date-generated">Date Generated</label>
                            <br>
                            <div class="sort-by">
                                <select class="js-select2" name="sort-by">
                                    <option disabled selected>Sort By</option>
                                    <option value="Quote Requested">Part Number</option>
                                    <option value="Quote Sent">Part Name</option>
                                    <option value="Order Received">Manufacturer</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        <span>
                            Clear
                        </span>
                    </button>
                    <input type="submit" value="Generate" class="contact100-form-btn">
                </div>
            </form>
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
                minimumResultsForSearch: 1,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
        // Display find RFQ if option is selected
        function yesnoCheck(that) {
            if (that.value == "find") {
                document.getElementById("ifYes").style.display = "block";
                document.getElementById("dates").style.display = "none";
                document.getElementById("dates").required = false;
                document.getElementById("from-date").required = false;
                document.getElementById("to-date").required = false;
                // document.getElementById("replaceMe").innerHTML = "<h5>It works!</h5>";
            } else {
                document.getElementById("ifYes").style.display = "none";
                document.getElementById("dates").style.display = "block";
            }
        }
        // Display find Detail report type is selected
        function reportType(that) {
        if (that.value == "detail") {
            document.getElementById("show-detail").style.display = "block";
        } else {
            document.getElementById("show-detail").style.display = "none";
        }
        }
    </script>
    <script src="../js/main.js"></script>
</body>

</html>