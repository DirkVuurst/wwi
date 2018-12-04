<?php
// include sql connect en php session file
include '../php/connectdb.php';
include '../php/shopping_cart/php_session.php';

$conn = getConnection();

// Shopping vars
$total_cost = 0;
$total_cost_btw = 0;
$send_cost = 3.50;
$send_cost_threshold = 20.00;
?>

<!DOCTYPE html><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wide World Importers</title>

    <link rel="import" href="../includes/imports.html">
</head>

<body>

<div w3-include-html="../includes/nav_bar.html.php?current=shopping_cart"></div>

<div style="margin-top: 50px" class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="card shopping-cart">
                <div class="card-header bg-dark text-light">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    Shopping cart
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <!-- PRODUCT AND COST-->
                    <?php include '../php/shopping_cart/shopping_cart.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="margin-top: 10%" w3-include-html="../includes/footer.html"></div>

<script>
    includeHTML();
</script>
</body>
</html>