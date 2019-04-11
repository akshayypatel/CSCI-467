<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/error.css" />
</head>
<body>

<?php
echo '<div class="container">
        <div class="content"> ';
    echo '<h1>' . $_SESSION["TITLE"] . '!</h1>';
    echo 'Redirecting you to ' . $_SESSION["REDIRECT-NAME"];
    echo '<br><br><span id="countdown">5</span>';

echo    '</div>
       </div>';

// Redirecting the user through a session variable opens up to session hijacking
// This is a better way to control urls
if ($_SESSION["REDIRECT"] == "create-part")
{
    header( "refresh:5;url=create-part.php" );
}
if ($_SESSION["REDIRECT"] == "create-rfq") 
{
    header( "refresh:5;url=create-rfq.php" );
}
if ($_SESSION["REDIRECT"] == "create-customer") 
{
    header( "refresh:5;url=create-customer.html" );
}
?>
<script>
    // Count down 
    var seconds = document.getElementById("countdown").textContent;
    var countdown = setInterval(function() {
        seconds--;
        document.getElementById("countdown").textContent = seconds;
        if (seconds <= 0) clearInterval(countdown);
    }, 1000);
</script>

</body>
</html>