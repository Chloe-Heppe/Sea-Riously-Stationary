<?php
// Connect to the database.
include "db.php";

$message = "";

// Check whether the registration form has been submitted.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Check that all required fields have been filled in.
    if ($username === "" || $email === "" || $password === "") {
        $message = "Please fill in all the fields.";
    } else {
        // Check if the username or email already exists.
        $check = $conn->prepare("SELECT userID FROM users WHERE username = ? OR email = ?");
        $check->bind_param("ss", $username, $email);
        $check->execute();

        if ($check->get_result()->num_rows > 0) {
            $message = "That username or email is already registered.";
        } else {
            // Hash the password instead of storing it as plain text.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database.
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }
    }
}
?>

<?php include "header.php"; ?>

<section class="form-page">
    <div class="form-card">
        <p class="eyebrow">JOIN THE CREW</p>
        <h1>Get <span>Shellfied</span></h1>
        <p>Create an account so you can dive into the store.</p>

        <?php if ($message !== ""): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email Address</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button class="button" type="submit">Create Account 🐚</button>
        </form>

        <p>Already registered? <a href="login.php">Log in here.</a></p>
    </div>
</section>

<?php include "footer.php"; ?>
