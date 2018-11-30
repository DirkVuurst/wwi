<?php 
    include '../php/php_session.php';
    include '../php/connectdb.php';
    $conn = getConnection();
    
        
    foreach($_SESSION["shopping_cart"] as $id => $aantal)
    {    
        // Haalt de gekochte items uit de voorrraad
        $query = "UPDATE stockitemholdings SET QuantityonHand = QuantityonHand -$aantal WHERE StockItemID = $id";
        $pro = $conn->prepare($query);
        $pro->execute();
        
        // Verwijderd het gekochte item uit de winkelmand
        unset($_SESSION["shopping_cart"][$id]);
    }  
?>

<!DOCTYPE html>
<html>
    Je hebt succesvol betaald!
    <form method="POST" action="../index.html.php">
        <button type="submit" class="btn btn-outline-danger btn-xs">
            Ga terug naar de home pagina
        </button>
    </form>
</html>