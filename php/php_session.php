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
            $_SESSION["shopping_cart"][$id] = 1;
        }     
        header("Location: ../pages/shopping_cart.html.php");
    } 
    
    // Check if id exists if so, delete item from the shopping cart
    if(isset($_GET['delete_id']))
    {
        $delete_id = preg_replace('#[^0-9]#i', '',$_GET['delete_id']);
        unset($_SESSION["shopping_cart"][$delete_id]); 
        header("Location: ../pages/shopping_cart.html.php");
    }

    // Check if count exists if so, add addition items to shopping cart
    if (isset($_GET['add_id']) && isset($_GET['amount']))
    {
        $add_id = preg_replace('#[^0-9]#i', '',$_GET['add_id']);
        $amount = preg_replace('#[^0-9]#i', '',$_GET['amount']);
        if ($amount <= 0)
        {
            unset($_SESSION["shopping_cart"][$add_id]);
        }
        else
        {
            $_SESSION["shopping_cart"][$add_id] = $amount; 
        }
        header("Location: ../pages/shopping_cart.html.php");
    } 
?>