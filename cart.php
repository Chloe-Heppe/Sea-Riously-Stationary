
<?php 
// Connect to the database and start the session.
include "db.php"; 


// CHECKOUT
// When the customer clicks checkout, empty the cart.
if (isset($_POST["checkout"])) {
    $_SESSION["cart"] = [];

    echo "<script>
        alert('Thanks for shopping! Your pretend order has been caught! 🐠');
        window.location.href = 'cart.php';
    </script>";
    exit();
}


// REMOVE AN ITEM FROM THE CART
if (isset($_GET["remove"])) { 
    $removeID = (int)$_GET["remove"]; 

    unset($_SESSION["cart"][$removeID]); 

    header("Location: cart.php"); 
    exit(); 
}


// UPDATE ITEM QUANTITIES
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["quantities"])) { 

    foreach ($_POST["quantities"] as $id => $quantity) { 

        $id = (int)$id; 
        $quantity = (int)$quantity; 


        // If the quantity is 0, remove the product.
        if ($quantity <= 0) { 
            unset($_SESSION["cart"][$id]); 
        } 
        
        else { 
            $_SESSION["cart"][$id] = $quantity; 
        } 
    } 

    header("Location: cart.php"); 
    exit(); 
}


// GET THE PRODUCTS FROM THE DATABASE
$cartProducts = []; 
$total = 0; 


if (!empty($_SESSION["cart"])) { 

    $ids = array_keys($_SESSION["cart"]); 

    $safeIDs = implode(",", array_map("intval", $ids)); 


    $result = $conn->query(
        "SELECT * FROM products WHERE productid IN ($safeIDs)"
    ); 


    while ($product = $result->fetch_assoc()) { 

        $cartProducts[] = $product; 

        $total += $product["price"] * $_SESSION["cart"][$product["productid"]]; 
    } 
}

?> 


<?php include "header.php"; ?> 


<!-- PAGE INTRO -->
<section class="page-intro"> 

    <p class="eyebrow">THE TRENCHER'S BASKET</p> 

    <h1>Your <span>Shell-ebration</span> Cart 🐚</h1> 

    <p>Check your catch before you take it home.</p> 

</section> 



<?php if (empty($cartProducts)): ?> 


    <!-- EMPTY CART -->
    <section class="empty-cart"> 

        <div class="big-emoji">🪼</div> 

        <h2>Your cart is feeling a little fishy...</h2> 

        <p>
            There are no stationery treasures swimming around here yet.
        </p> 

        <a class="button" href="store.php">
            Go Fishing For Stationery
        </a> 

    </section> 



<?php else: ?> 


    <!-- CART FORM -->
    <form method="POST"> 

        <section class="cart-layout"> 


            <!-- CART ITEMS -->
            <div class="cart-items"> 


                <?php foreach ($cartProducts as $product): ?> 


                    <article class="cart-item"> 


                        <!-- Product image -->
                        <img 
                            src="<?php echo htmlspecialchars($product["Image"]); ?>" 
                            alt="<?php echo htmlspecialchars($product["name"]); ?>"
                        > 


                        <div class="cart-item-info"> 


                            <h2>
                                <?php echo htmlspecialchars($product["name"]); ?>
                            </h2> 


                            <p>
                                R<?php echo number_format($product["price"], 2); ?> each
                            </p> 


                            <!-- Quantity -->
                            <label> 

                                Quantity:

                                <input 
                                    type="number" 
                                    name="quantities[<?php echo $product["productid"]; ?>]" 
                                    value="<?php echo $_SESSION["cart"][$product["productid"]]; ?>" 
                                    min="0"
                                > 

                            </label> 


                            <!-- Remove item -->
                            <a 
                                class="remove-link" 
                                href="cart.php?remove=<?php echo $product["productid"]; ?>"
                            > 
                                Remove from cart 
                            </a> 


                        </div> 


                    </article> 


                <?php endforeach; ?> 


                <!-- Update quantities -->
                <button 
                    class="small-button update-button" 
                    type="submit"
                > 
                    Update Cart 
                </button> 


            </div> 



            <!-- CHECKOUT BOX -->
            <aside class="checkout-box"> 

                <p class="eyebrow">CHECKOUT</p> 

                <h2>Ready to make waves?</h2> 


                <!-- Total -->
                <div class="total-row"> 

                    <span>Total</span> 

                    <strong>
                        R<?php echo number_format($total, 2); ?>
                    </strong> 

                </div> 



                <!-- Checkout button -->
                <button 
                    class="button checkout-button" 
                    type="submit" 
                    name="checkout"
                > 
                    Checkout 🐳 
                </button> 


                <p class="checkout-note"> 
                    This student project uses a simulated checkout. 
                    No real payment is processed. 
                </p> 


            </aside> 


        </section> 

    </form> 


<?php endif; ?> 



<?php include "footer.php"; ?>