<?php
include("./php/connectdb.php");

$categorie_id = 1;
$search = "";

if (isset($_GET['categorie_id']) && !empty($_GET['categorie_id'])) {
    $categorie_id = filter_input(INPUT_GET, 'categorie_id', FILTER_VALIDATE_INT);
}

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
}

if (isset($_GET['stock_item_id']) && !empty($_GET['stock_item_id'])) {
    $stock_item_id = filter_input(INPUT_GET, 'stock_item_id', FILTER_VALIDATE_INT);
}

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = filter_input(INPUT_POST, 'search');
    print ("post search" . $search);
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

    <link rel="import" href="includes/imports.html">

    <style>
        .category_block li:hover {
            background-color: #007bff;
        }
        .category_block li:hover a {
            color: #ffffff;
        }
        .category_block li a {
            color: #343a40;
        }
    </style>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="./index.html.php"><img class="img-responsive" width="195" height="71"
                                                              src="./images/logo.png"/></a>
        <form style="padding-top: 10px;" method="post" action="./index.html.php?<?php
            if (!empty($categorie_id)) { echo "categorie_id=" . intval($categorie_id); }
            if (!empty($search)) { echo ("&search=" . $search); }
        ?>">
            <div class="input-group mb-6">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"> <i  class="fa fa-search fa-9"></i></span>
                </div>
                <input id="search" name="search" type="text" class="form-control" placeholder="Search">
            </div>
        </form>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.html.php">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/register_page.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pages/overons_page.html.php">Over ons</a>
                </li>

                <li id="shopping-cart-icon" class="nav-item active ">
                    <a href="./pages/shopping_cart.html.php"> <i class="blackiconcolor fa fa-shopping-cart fa-2x"></i> </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content -->
<div class="container" style="margin-top: 35px">
    <div class="row">
        <!-- Check if stockitem was passed to this file because then we know we need to load product information. Other wise just load product overview  -->
        <?php
        if (!empty($stock_item_id)) { ?>
            <!-- Product information page -->
            <div class="col-lg-12"
                 w3-include-html="./pages/productinfo_page.php?stock_item_id=<?php echo $stock_item_id ?>"></div>
        <?php } else { ?>
            <!-- Product overview page -->
            <div class="col-lg-12"
                 w3-include-html="./pages/productlist_page.php?categorie_id=<?php if (!empty($categorie_id)) {
                     echo intval($categorie_id);
                 } ?>&page=<?php if (!empty($page)) {
                     echo intval($page);
                 } ?>&search=<?php if (!empty($search)) {
                     echo $search;
                 } ?>">
            </div>
        <?php } ?>
    </div>
</div>

<div w3-include-html="./includes/footer.html"></div>

</body>

<script>
    includeHTML();

    // Handles click in search bar.
    $('#filtersubmit').click(function () {
        alert('Searching for ' + $('#filter').val());
    });
</script>
</html>