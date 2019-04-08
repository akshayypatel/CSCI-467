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
    <link rel="stylesheet" type="text/css" href="../css/create-customer.css" />
    <link rel="stylesheet" type="text/css" href="../css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <script src="../js/modernizr.custom.js"></script>
    <?php
		require ("../php-actions/connect.php");
		$query = $pdo->query("SELECT partID FROM inventory_part WHERE partID = (SELECT MAX(partID) FROM inventory_part)");
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$partID = $row['partID'];
		$partID = $partID + 1;
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
                            <li><a class="gn-icon gn-icon-help" href="create-rfq.php">Request For Quote</a></li>
                            <li><a class="gn-icon gn-icon-help" href="generate-rfq-report.html">Generate RFQ Report</a></li>
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
                    Create Request For Quote
                </span>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                    <span class="label-input100">RFQ ID</span>
                    <div>
                        <select class="js-select2" name="rfq-id">
                            <option disabled selected>Select RFQ ID</option>
                            <option value="101">101</option>
                            <option value="102">102</option>
                            <option value="103">103</option>
                            <option value="104">104</option>
                            <option value="105">105</option>
                            <option value="106">106</option>
                            <option value="107">107</option>
                            <option value="108">108</option>
                            <option value="109">109</option>
                            <option value="110">110</option>
                            <option value="111">111</option>
                            <option value="112">112</option>
                            <option value="113">113</option>
                            <option value="114">114</option>
                            <option value="115">115</option>
                            <option value="116">116</option>
                            <option value="117">117</option>
                            <option value="118">118</option>
                            <option value="119">119</option>
                            <option value="120">120</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="wrap-input100 input100-select bg1 rs1-wrap-input100 w250">
                    <span class="label-input100">Status</span>
                    <div>
                        <select class="js-select2" name="rfq-id">
                            <option disabled selected>Current Status</option>
                            <option value="Quote Requested">Quote Requested</option>
                            <option value="Quote Sent">Quote Sent</option>
                            <option value="Order Received">Order Received</option>
                            <option value="Order Fulfilled">Order Fulfilled</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>
                </div>

                <div class="wrap-input100 bg1 rs1-wrap-input100 w250">
                    <span class="label-input100">Customer ID</span>
                    <input class="input100" type="text" name="name" placeholder="50205" readonly>
                </div>

                <div class="line-break center">
                    <span class="line-break-label">Columns to be included</span>
                </div>

                <div class="wrap-input100 bg1 rs1-wrap-input100 checkboxes">
                    <input type="checkbox" id="part-number" name="part-number">
                    <label class="line-break-label" for="part-number">Part Number</label>
                    <br>
                    <input type="checkbox" id="part-number" name="part-description">
                    <label class="line-break-label" for="part-description">Part Description</label>
                    <br>
                    <input type="checkbox" id="part-number" name="part-price">
                    <label class="line-break-label" for="part-price">Part Price</label>
                    <br>
                    <input type="checkbox" id="part-number" name="part-quantity">
                    <label class="line-break-label" for="part-quantity">Part Quantity</label>
                </div>

                <div class="wrap-input100 bg1 rs1-wrap-input100 checkboxes">
                    <input type="checkbox" id="date-required" name="date-required">
                    <label class="line-break-label" for="date-required">Date Required</label>
                    <br>
                    <input type="checkbox" id="date-generated" name="date-generated">
                    <label class="line-break-label" for="date-generated">Date Generated</label>
                    <br>
                    <input type="checkbox" id="comments" name="comments">
                    <label class="line-break-label" for="comments">Comments</label>
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

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn">
                        <span>
                            Clear
                        </span>
                    </button>
                    <button class="contact100-form-btn">
                        <span>
                            Generate
                            <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                        </span>
                    </button>
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
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="../js/main.js"></script>
</body>

</html>