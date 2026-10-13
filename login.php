<?php
// Connect to the database.
include "db.php";

$message = "";

// Check whether the login form has been submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    // Find the user by username.
    $stmt = $conn->prepare("SELECT userID, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check the entered password against the hashed database password.
    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["username"] = $user["username"];
        $_SESSION["userID"] = $user["userID"];

        header("Location: index.php");
        exit();
    } else {
        $message = "Those login details did not match. Please try again.";
    }
}
?>

<?php include "header.php"; ?>

<section class="form-page">
    <div class="form-card">
        <p class="eyebrow">WELCOME BACK</p>
        <h1>Let's Get <span>O-fish-ial</span></h1>
        <p>Log in and get back to shopping.</p>

        <?php if (isset($_GET["registered"])): ?>
            <div class="success-message">Account created! You can now log in.</div>
        <?php endif; ?>

        <?php if ($message !== ""): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button class="button" type="submit">Dive Back In 🐠</button>
        </form>

        <p>New here? <a href="register.php">Create an account.</a></p>
    </div>
</section>

<?php include "footer.php"; ?>
