<?php
session_start();
ob_start();
if (!isset($_SESSION["cart"]))
{
    $_SESSION["cart"] = array();
}
function show_header(){ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Internet Shop</title>
    <meta http-equiv="Location" content="/shop/web/">
    <link rel="stylesheet" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/jquery.session.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<header>
</header>



<?php
}

    function show_footer(){

        ob_start();
?>
</body>
</html>
<?php ob_end_clean(); }   ?>




