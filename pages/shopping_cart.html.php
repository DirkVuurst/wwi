<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="../index.html.php"><img class="img-responsive" width="195" height="71" src="../images/logo.png"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.html.php">
                        Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_page.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="overons_page.html.php">Over ons</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand" href="shopping_cart.html.php"><img class="img-responsive" width="44" height="35" src="../images/shopping_cart.png"/></a>
    </div>
</nav>

<!-- Body -->
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<div class="container" style="padding-top:8%">
   <div class="card shopping-cart">
        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Shopping cart
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <!-- PRODUCT AND COST-->
            <?php include '../php/shopping_cart.php'; ?>
        </div>
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