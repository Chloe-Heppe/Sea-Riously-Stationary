<?php
// Start a session so the cart and logged-in user can be remembered.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create an empty cart if one does not exist yet.
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Count how many items are currently in the cart.
$cartCount = array_sum($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- This makes the website work better on phones and tablets. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- The page title shown in the browser tab. -->
    <title>Sea-riously Stationery</title>

    <!-- Connect the HTML pages to the main CSS file. -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- This animated GIF is used as a decorative underwater background. -->
<div class="bubble-layer"></div>

<header class="site-header">
    <a class="logo" href="index.php">SEA-RIOUSLY ✦</a>

    <!-- Main navigation used throughout the website. -->
    <nav>
        <a href="index.php">Home</a>
        <a href="store.php">Store</a>
        <a href="cart.php">Cart 🛒 <span class="cart-count"><?php echo $cartCount; ?></span></a>

        <?php if (isset($_SESSION["username"])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Sign Up</a>
        <?php endif; ?>
    </nav>
</header>

<main>
