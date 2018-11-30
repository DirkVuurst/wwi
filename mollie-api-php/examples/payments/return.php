<?php

namespace _PhpScoper5be2fdb7243e7;

/*
 * How to show a return page to the customer.
 *
 * In this example we retrieve the order stored in the database.
 * Here, it's unnecessary to use the Mollie API Client.
 */
/*
 * NOTE: The examples are using a text file as a database.
 * Please use a real database like MySQL in production code.
 */
require_once "../functions.php";
if (isset($_GET["order_id"])) {
    $status = \_PhpScoper5be2fdb7243e7\database_read($_GET["order_id"]);
} else {
    $status = "No order number defined";
}
echo 'Je hebt betaald!';
header("Location: ../../../index.html.php");