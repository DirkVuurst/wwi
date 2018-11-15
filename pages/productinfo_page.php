<?php
include '../php/connectdb.php';
include '../php/utils.php';
include '../php/php_session.php';

//kijkt naar het StockItemID wat je hebt meegegeven aan het product
if(isset($_GET['stock_item_id'])){
   $id = preg_replace('#[^0-9]#i', '',$_GET['stock_item_id']);
}
else {
    echo "no such product exist";
    exit();
}

// initialize product information.
$productInfo = getProductInformation();
$productId = $productInfo["StockItemID"];
$productNameTrimmed = $productInfo["StockItemNameTrimmed"];
$fullProductName = $productInfo["StockItemName"];
$productPrice = $productInfo["RecommendedRetailPrice"];
$stars = $productInfo["ReviewStarts"];
$itemsAvailible = getStockItemCountInArchive($id);

function getReviews(){
    global $id;

    $connection = getConnection();
    $rev = $connection->prepare("SELECT Tekst, Stars, ReviewID FROM review where StockItemID ='$id'");
    $rev->execute();

    $reviews = array();

    while ($row = $rev->fetch()) {
        $reviewsTekst = $row["Tekst"];
        $reviewsStars = $row["Stars"];
        $reviewsID = $row["ReviewID"];

        $reviews_item = [
            "ReviewTekst" => $reviewsTekst,
            "ReviewStars" => $reviewsStars
        ];
        $reviews[$reviewsID] = $reviews_item;
    }

    return $reviews;
}

/// Get basic information from stockitem by stockitem id.
function getProductInformation() {
    global $id;

    $connection = getConnection();
    $pdo = $connection->prepare("SELECT s.StockItemID, StockItemName, RecommendedRetailPrice, AVG(r.Stars) as Stars FROM stockitems s LEFT JOIN review r ON r.StockItemID = s.StockItemID WHERE s.StockItemID ='$id'");
    $pdo->execute();
    $stockItemsInfo = array();

    while ($row = $pdo->fetch()) {
        $product_name = remove_color_from_stockitem($row["StockItemName"]);

        $stockItemsInfo["StockItemID"] = $row["StockItemID"];
        //foto row is blob file werkt nog niet, we gebruiken nu een test foto
        //$photo = $row["Photo"];
        $stockItemsInfo["StockItemNameTrimmed"] = $product_name;
        $stockItemsInfo["StockItemName"] = $row["StockItemName"];
        $stockItemsInfo["RecommendedRetailPrice"] = $row["RecommendedRetailPrice"];
        $stockItemsInfo["ReviewStarts"] = $row["Stars"];

    }

    return $stockItemsInfo;
}

/// Get available colors by product name.
function getAvailableColors() {
    global $productNameTrimmed;

    $connection = getConnection();

    $col = $connection->prepare("SELECT c.ColorName , c.ColorID FROM colors c LEFT JOIN stockitems s ON s.ColorID = c.ColorID WHERE StockItemName LIKE '$productNameTrimmed%'");
    $col->execute();

    $colors = array();

    while ($row = $col->fetch()) {
        $color_name = $row["ColorName"];
        $color_id = $row["ColorID"];

        $color_item = [
            "ColorID" => $color_id,
            "ColorName" => $color_name
        ];
        $colors[$color_id] = $color_item;
    }

    return $colors;
}

/// Get specific count of stock items in archive.
function getStockItemCountInArchive($id)
{
    $connection = getConnection();
    $tal = $connection->prepare("SELECT QuantityOnHand as aantal FROM stockitemholdings WHERE StockItemID ='$id'");
    $tal->execute();

    while ($row = $tal->fetch()) {
        $itemsAvailible = $row["aantal"];

        return $itemsAvailible;
    }
}


?>
<div class="row" style="margin-top: 100px">
    <div class="col-md-7">
        <div class="product col-md-3 service-image-left">
                <img id="item-display" src="http://placehold.it/400x300" alt=""></img>
        </div>
    </div>

    <div class="col-md-4">
        <div class="product-title"> <?php echo $productNameTrimmed ?></div>
        <div class="product-desc"> <?php echo $fullProductName ?></div>
        <div class="product-rating">
            <?php
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $stars) {
                        echo "<i class=\"fa fa-star gold\"></i>";
                    }else {
                        echo "<i class=\"fa fa-star-o\"></i>"  ;
                    }
                }
            ?>
        </div>
        <hr>
        <div class="product-price">&euro; <?php echo $productPrice ?></div>
        <h6 class="title-attr" style="margin-top:15px;" ><small>Kleur</small></h6>

        <!-- --->
        <?php
        $colorOptions = getAvailableColors();

        if(empty($colorOptions)){

        } else {
            // print all color options.
            foreach ($colorOptions as $key => $value) {
                $color = str_replace(' ', '', strtolower($value["ColorName"]));
                print ("<div class=\"attr\" style=\"width:25px;background:$color;float:left;\"></div>");
            }
        }
        ?>

        <div class="product-stock">Beschikbaar: <?php echo $itemsAvailible ?> </div>
        <hr>
        <div class="btn-group cart">
            <form method="POST" action="./php/php_session.php?id=<?php echo $id; ?>">
                <input type="submit" value="Toevoegen aan de winkelmand" class="btn btn-success">
                </input>
            </form>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-md-12 product-info">
            <ul id="myTab" class="nav nav-tabs nav_tabs">
                <li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>
            </ul>
            <form method="POST" action="./php/product_review_handler.php?stock_item_id=<?php echo $productId ?>" onsubmit="alert('Bedankt voor uw review!')">
                <label for="review">Schrijf een korte review over <?php print $productNameTrimmed?></label>
                    <textarea class="form-control animated" cols="65" id="review" name="review" placeholder="Type hier u review..." rows="4"></textarea>
                    <!-- Cijfer-->
                    <div class="form-group" id="cijfer">
                        <label for="Cijfer">Geeft een cijfer aan het product</label>
                        <select class="form-control" id="cijfer" name="cijfer" required>
                            <option value="">Geef een cijfer</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                    </div>
                    <!--Submit knop-->
                    <button class="btn btn-success mb-2" type="submit" name="versturen" id="versturen">Versturen</button>
            </form>
        </div>
            <?php
            $getReview = getReviews();

                    if (empty($getReview)) {
                            print("Geen reviews voor dit product");
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
            <hr>
        </div>
    </div>
</div>