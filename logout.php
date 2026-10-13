<?php
// Start the session so it can be ended.
session_start();

// Remove all session information.
session_unset();
session_destroy();

// Send the user back to the home page.
header("Location: index.php");
exit();
?>
