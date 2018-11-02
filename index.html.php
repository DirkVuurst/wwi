<?php
include("./php/connectdb.php");
    
$categorie_id = 1;

if(isset($_GET['categorie_id']) && !empty($_GET['categorie_id'])){
    $categorie_id = filter_input(INPUT_GET, 'categorie_id', FILTER_VALIDATE_INT);
}

if(isset($_GET['stock_item_id']) && !empty($_GET['stock_item_id'])){
    $stock_item_id = filter_input(INPUT_GET, 'stock_item_id', FILTER_VALIDATE_INT);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wide World Importers</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html.php">Wide World Importers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.html.php">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/overons_page.html.php">Over ons</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-3" w3-include-html="./pages/category_page.php"> </div>

        <!-- Check if stockitem was passed to this file because then we know we need to load product information. Other wise just load product overview  -->
        <?php
        if (!empty($stock_item_id)) { ?>
            <!-- Product information page -->
            <div class="col-lg-9" w3-include-html="./pages/productinfo_page.php?stock_item_id=<?php echo $stock_item_id ?>"</div>
        <?php } else { ?>
            <!-- Product overview page -->
            <div class="col-lg-9" w3-include-html="./pages/productlist_page.php?categorie_id=<?php echo intval($categorie_id) ?>"</div>
        <?php } ?>

    </div>
</div>


<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <div class="row">
        <div class="col-sm text-white">
                <br><b>Contactgegevens:</b><br/>
                Wide World Importers, <br/>
                Campus 2, 8017 CA Zwolle<br/>
                Telefoon: +852 129 209 291<br/>
                Mail: <a href="mailto:info@wwi.com">info@wwi.com</a><br />
        </div>
            <div class="col-sm text-white">
                <br><b>Social Media:</b><br/>
                <a href="https://www.facebook.com/"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
                <a href="https://twitter.com/"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                <a href="https://instagram.com"><i id="social-in" class="fa fa-instagram fa-3x social" ></i></a>                    
                <a href="mailto:info@wwi.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
           </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

<script>

    includeHTML();

    /// This will load all the pages located in other files. All elements with attribute 'w3-include-html' will be checked.
    function includeHTML() {
        var z, i, elmnt, file, xhttp;
        /*loop through a collection of all HTML elements:*/
        z = document.getElementsByTagName("*");
        for (i = 0; i < z.length; i++) {
            elmnt = z[i];
            /*search for elements with a certain atrribute:*/
            file = elmnt.getAttribute("w3-include-html");
            if (file) {
                /*make an HTTP request using the attribute value as the file name:*/
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {elmnt.innerHTML = this.responseText;}
                        if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
                        /*remove the attribute, and call this function once more:*/
                        elmnt.removeAttribute("w3-include-html");
                        includeHTML();
                    }
                }
                xhttp.open("GET", file, true);
                xhttp.send();
                /*exit the function:*/
                return;
            }
        }
    }
</script>
</html>