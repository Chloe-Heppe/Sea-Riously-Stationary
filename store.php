<?php
// Connect to the database so every product can be loaded from MySQL.
include "db.php";

// Get all products for the store catalogue.
$result = $conn->query("SELECT * FROM products ORDER BY productid ASC");
?>

<?php include "header.php"; ?>

<section class="page-intro">
    <p class="eyebrow">WELCOME TO THE TIDAL AISLE</p>
    <h1>The <span>Fin-tastic</span> Stationery Store</h1>
    <p>Everything you need to make your notes, desk and study sessions look sea-riously cute.</p>
</section>

<div class="product-grid store-grid">
    <?php while ($product = $result->fetch_assoc()): ?>
        <article class="product-card">
            <!-- Show the product picture saved in the database. -->
            <img src="<?php echo htmlspecialchars($product["Image"]); ?>"
                 alt="<?php echo htmlspecialchars($product["name"]); ?>">

            <div class="product-info">
                <p class="product-creature">🐚 OCEAN PICK</p>
                <h2><?php echo htmlspecialchars($product["name"]); ?></h2>
                <p><?php echo htmlspecialchars($product["description"]); ?></p>
                <strong>R<?php echo number_format($product["price"], 2); ?></strong>

                <!-- Send the product ID to the details page. -->
                <a class="small-button" href="product.php?id=<?php echo $product["productid"]; ?>">
                    View Details
                </a>

                <form method="POST" action="add_to_cart.php">
    <input type="hidden" name="productid" value="<?php echo $product["productid"]; ?>">
    <button class="small-button" type="submit">
        Add to Cart 🛒
    </button>
</form>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php include "footer.php"; ?>
