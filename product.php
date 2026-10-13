<?php
// Connect to the database.
include "db.php";

// Get the product ID from the URL.
$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

// Find the selected product in the database.
$stmt = $conn->prepare("SELECT * FROM products WHERE productid = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// If the product does not exist, send the user back to the store.
if (!$product) {
    header("Location: store.php");
    exit();
}

// Add the product to the session cart when the Add to Cart button is pressed.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]++;
    } else {
        $_SESSION["cart"][$id] = 1;
    }

    header("Location: cart.php");
    exit();
}
?>

<?php include "header.php"; ?>

<section class="detail-page">
    <div class="detail-image">
        <!-- Display the selected product image. -->
        <img src="<?php echo htmlspecialchars($product["Image"]); ?>"
             alt="<?php echo htmlspecialchars($product["name"]); ?>">
    </div>

    <div class="detail-content">
        <p class="eyebrow">YOU CAUGHT ONE!</p>
        <h1><?php echo htmlspecialchars($product["name"]); ?></h1>
        <p class="price">R<?php echo number_format($product["price"], 2); ?></p>

        <p class="detail-description">
            <?php echo htmlspecialchars($product["description"]); ?>
        </p>

        <ul class="feature-list">
            <li>🌊 Ocean-inspired design</li>
            <li>🐠 Student-friendly stationery</li>
            <li>🐚 Perfect for your study desk</li>
        </ul>

        <!-- Submit this form to add one item to the shopping cart. -->
        <form method="POST">
            <button class="button" type="submit">Add To Cart 🐟</button>
        </form>

        <a class="back-link" href="store.php">← Back to the store</a>
    </div>
</section>

<?php include "footer.php"; ?>
