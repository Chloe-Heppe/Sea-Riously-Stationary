<?php
// Connect to the database so we can show real products on the home page.
include "db.php";

// Get three products from the database for the featured section.
$result = $conn->query("SELECT * FROM products ORDER BY productid DESC LIMIT 3");
?>

<?php include "header.php"; ?>

<section class="hero">
    <div class="hero-text">
        <p class="eyebrow">WELCOME TO THE DEEP</p>
        <h1>Make a <span>fin-tastic</span> first impression.</h1>
        <p>
            Dive into a bubbly little stationery shop packed with notebooks,
            pens, stickers and desk goodies for students who want their notes
            to be as cute as the ocean.
        </p>

        <!-- This button takes the customer to the product catalogue. -->
        <a class="button" href="store.php">Dive Into The Store 🐠</a>
    </div>

    <!-- Animated ocean GIF of waving penguin. He is waving hello to the users. -->
    <img class="hero-gif"
         src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExeXcwNTNkbnEzeHBnNWc3dXpsN212c3ozb2Jndnk4Mjg1N2xjcHh0ZCZlcD12MV9naWZzX3NlYXJjaCZjdD1n/74p7H2qlQgeoXqW7e1/giphy.gif"
         alt="Animated underwater fish">
</section>

<section class="welcome-section">
    <div class="section-heading">
        <p class="eyebrow">WHAT'S SWIMMING AROUND?</p>
        <h2>Stationery that's <span>shore</span> to make you smile.</h2>
    </div>

    <div class="creature-row">
        <div class="creature">
            <div class="creature-icon">🐙</div>
            <h3>Octo-pen-sational</h3>
            <p>Writing supplies with plenty of arms to help your ideas come together.</p>
        </div>

        <div class="creature">
            <div class="creature-icon">🐚</div>
            <h3>Shell Yeah!</h3>
            <p>Pretty paper goods for notes, lists, doodles and everything in between.</p>
        </div>

        <div class="creature">
            <div class="creature-icon">🪼</div>
            <h3>Jelly Good Ideas</h3>
            <p>Fun desk accessories that make studying feel a little less serious.</p>
        </div>
    </div>
</section>

<section class="featured">
    <div class="section-heading">
        <p class="eyebrow">CURRENT CATCH</p>
        <h2>Hook your next favourite.</h2>
    </div>

    <div class="product-grid">
        <?php while ($product = $result->fetch_assoc()): ?>
            <article class="product-card">
                <!-- Product image comes from the database. -->
                <img src="<?php echo htmlspecialchars($product["Image"]); ?>"
                     alt="<?php echo htmlspecialchars($product["name"]); ?>">

                <div class="product-info">
                    <p class="product-creature">SEA CREATURE FAVOURITE</p>
                    <h3><?php echo htmlspecialchars($product["name"]); ?></h3>
                    <p><?php echo htmlspecialchars($product["description"]); ?></p>
                    <strong>R<?php echo number_format($product["price"], 2); ?></strong>

                    <a class="small-button" href="product.php?id=<?php echo $product["productid"]; ?>">
                        View Details
                    </a>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</section>

<section class="callout">
    <div>
        <p class="eyebrow">READY TO MAKE WAVES?</p>
        <h2>Your desk deserves a little ocean magic.</h2>
    </div>
    <a class="button light-button" href="store.php">Shop All Stationery</a>
</section>

<?php include "footer.php"; ?>
