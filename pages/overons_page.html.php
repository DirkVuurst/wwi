<?php
include "../php/connectdb.php";

function getReviews()
{
    $connection = getConnection();
    $rev = $connection->prepare("SELECT Tekst, Stars, ReviewBedrijfID FROM review_bedrijf where BedrijfID =1");
    $rev->execute();

    $reviews = array();

    while ($row = $rev->fetch()) {
        $reviewsTekst = $row["Tekst"];
        $reviewsStars = $row["Stars"];
        $reviewsID = $row["ReviewBedrijfID"];

        $reviews_item = [
            "ReviewTekst" => $reviewsTekst,
            "ReviewStars" => $reviewsStars
        ];
        $reviews[$reviewsID] = $reviews_item;
    }
    return $reviews;
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

    <link rel="import" href="../includes/imports.html">
</head>

<body>

<div w3-include-html="../includes/nav_bar.html.php"></div>

<div style="margin-top: 50px">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-6">
                <div class="about-title clearfix">
                    <h1>Over<span> Ons</span></h1>
                    <h3>Wide World Importers</h3>
                    <p class="about-paddingB">Wij zijn WWI. We zijn trots op onze producten en geloven in kwaliteit. In
                        ieder huis vindt een
                        product van WWI zijn thuis. Ondanks onze grootte zien klanten ons als kleinschalig en
                        betrokken. Persoonlijk klantcontact staat bij ons hoog in het vaandel</p>
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="../images/Kim_Helmink.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="../images/pand.png" alt="Second slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col-sm" style="style=margin-top: 35px">
                <br><b>Contactgegevens:</b><br/>
                Wide World Importers, <br/>
                Campus 2, 8017 CA Zwolle<br/>
                Telefoon: +852 129 209 291<br/>
                Mail: <a href="mailto:info@wwi.com">info@wwi.com</a><br/><br/>

                <div class="about-icons">
                    <a href="https://www.facebook.com/"><i id="social-fb"
                                                           class="fa fa-facebook-square fa-3x social"></i></a>
                    <a href="https://twitter.com/"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                    <a href="https://instagram.com"><i id="social-in" class="fa fa-instagram fa-3x social"></i></a>
                    <a href="mailto:info@wwi.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
                </div>
            </div>
        </div>

        <hr>
        <div class="container-fluid">
            <div class="col-md-7 product-info">
                <ul id="myTab" class="nav nav-tabs nav_tabs">
                    <li><a href="#service-three" data-toggle="tab">REVIEWS OVER WWI</a></li>
                </ul>
                <form method="POST" action="../php/reviews/bedrijf_review_handler.php"
                ">
                <label for="review">Schrijf een korte review over Wide World Importers</label>
                <textarea class="form-control animated" cols="65" id="review" name="review"
                          placeholder="Type hier u review..." rows="4" required></textarea>
                <!-- Cijfer-->
                <div class="form-group" id="cijfer">
                    <label></label>
                    <select class="form-control" id="cijfer" name="cijfer" required>
                        <option value="">Geef het aantal sterren</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <!--Submit knop-->
                <button class="btn btn-success mb-2" type="submit" name="versturen" id="versturen">Versturen</button>
                </form>
            </div>
            <div class="col-md-7">
                <?php
                $getReview = getReviews();

                if (empty($getReview)) {
                    print("Geen reviews over Wide World Importers");
                } else {
                    foreach ($getReview as $key => $value) {
                        $stars = $value['ReviewStars'];
                        for ($i = 0; $i < 5; $i++) {
                            if ($i < $stars) {
                                echo "<i class=\"fa fa-star gold\"></i>";
                            } else {
                                echo "<i class=\"fa fa-star-o\"></i>";
                            }


                        }
                        print ("<br>" . $value['ReviewTekst'] . "<br><hr>");
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div w3-include-html="../includes/footer.html"></div>

    <script>
        includeHTML();
    </script>
</body>
</html>