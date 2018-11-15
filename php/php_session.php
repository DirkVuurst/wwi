<?php  
    session_start(); // Starten van de session

    // Check if id exists if so, call the add function
    if(isset($_GET['id']))
    {
        $id = preg_replace('#[^0-9]#i', '',$_GET['id']);
        if (isset($_SESSION["shopping_cart"][$id]))
        {
            $_SESSION["shopping_cart"][$id] += 1;
        }
        else
        {
            $_SESSION["shopping_cart"][$id] += 1;
        }
        
        header("Location: ../pages/shopping_cart.html.php");
    } 
    
    // Check if id exists if so, delete item from the shopping cart
    if(isset($_GET['delete_id']))
    {
        $delete_id = preg_replace('#[^0-9]#i', '',$_GET['delete_id']);
        $shopping_cart_item[$delete_id] = 1;
        unset($_SESSION["shopping_cart"][$delete_id]); 
        header("Location: ../pages/shopping_cart.html.php");
    } 
?>