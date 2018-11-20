<?php 
    // include sql connect en php session file
    include '../php/connectdb.php';
    include '../php/php_session.php';
    $conn = getConnection();

    // Shopping vars
    $total_cost = 0;
    $total_cost_btw = 0;
    $send_cost = 3.50;
    $send_cost_threshold = 20.00;
?>
<h1 class="my-4">Winkelmand</h1>
<div class="list-group">
    <?php
        if (!empty($_SESSION["shopping_cart"]))
        {
            foreach($_SESSION["shopping_cart"] as $index => $value)
            {
                $query = "SELECT StockItemID, StockItemName, RecommendedRetailPrice * $value as Cost, TaxRate as Tax FROM stockitems  WHERE StockItemID = $index";
                $result = $conn->query($query);

                $pro = $conn->prepare($query);
                $pro->execute();

                while ($row = $pro->fetch())
                {
                    $item_name = $row["StockItemName"];
                    $item_id = $row["StockItemID"];
                    $cost = $row["Cost"];
                    $tax = $cost/100 * $row["Tax"] ;
                    $price = $cost - $tax;
                    ?>
                    <div class="row">
                            <div class="col-12 col-sm-12 col-md-2 text-center">
                                    <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
                            </div>
                            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                                <h4 class="product-name"><strong> <?php echo $item_name; ?>  </strong></h4>
                                <h4>
                                    <small>Product beschrijving</small>
                                </h4>
                            </div>
                            <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                                <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                    <h6><strong> Totaal: &#8364; <?php echo $cost; ?> <span class="text-muted"></span></strong></h6>
                                    <h6> prijs: &#8364; <?php echo number_format($price, 2) ?>  <span class="text-muted"></span></h6>
                                    <h6> BTW: &#8364; <?php echo number_format($tax, 2) ?> <span class="text-muted"></span></h6>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4">
                                    <div class="quantity">
                                        <form method="POST" action="../php/php_session.php?add_id=<?php echo $index; ?>&amount=<?php echo $value+1; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-xs" style="width:35px">+</button>
                                        </form>
                                        <form><h6><strong>Aantal: </strong><?php echo $value; ?></h6></form>
                                        <form method="POST" action="../php/php_session.php?add_id=<?php echo $index; ?>&amount=<?php echo $value-1; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-xs" style="width:35px">-</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 text-right">
                                    <form method="POST" action="../php/php_session.php?delete_id=<?php echo $index; ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-xs">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- END PRODUCT -->
                        <?php
                    $total_cost += $cost;
                    $total_cost_btw += $tax;
                }
            $total_product = $total_cost - $total_cost_btw; 
            }
        }
        else
        {
            echo '<h4 class="product-name"><em> Je winkelmand is nog leeg! </em></h4>';
        }
        
        if ($total_cost >= $send_cost_threshold || $total_cost <= 0) 
        {
            $send_cost = 0.00;
        }
    ?>
</div>
<!-- The price and checkout -->
<div class="btn btn-success pull-right" style="margin: 10px">
    <div class="pull-right" style="margin: 5px">
        details kosten: <br>
        Product kosten: <b> &#8364; <?php if (!empty($total_product)) {echo number_format($total_product, 2);} else {echo number_format($send_cost, 2);}?></b> <br>
        Totale btw kosten: <b> &#8364; <?php echo number_format($total_cost_btw, 2); ?></b> <br>
        Verzendkosten: <b> &#8364; <?php echo number_format($send_cost, 2); ?></b> <br>
        <br> Totaal: <b> &#8364; <?php echo number_format($total_cost, 2); ?></b>
        <form method="POST" action="../pages/payment.html.php?cost=<?php echo number_format($total_cost, 2); ?>">  
            <?php
                if ($total_cost > 0)
                {
                    echo '<button type="submit" class="card-header bg-dark text-light">Betalen</button>';
                }
            ?>
        </form>
    </div>
</div>  