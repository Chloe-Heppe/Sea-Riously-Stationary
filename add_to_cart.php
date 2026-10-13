<?php

include "db.php";

// Get the product ID
$productid = (int)$_POST["productid"];

// Create the cart if it does not exist yet
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Add the product to the cart
if (isset($_SESSION["cart"][$productid])) {
    $_SESSION["cart"][$productid]++;
} else {
    $_SESSION["cart"][$productid] = 1;
}

// Go back to the store
header("Location: store.php");
exit();

?>