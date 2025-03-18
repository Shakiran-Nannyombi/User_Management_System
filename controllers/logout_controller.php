<?php
session_start();
include '../includes/user_management.php';

// Clear session data
session_unset();
session_destroy();

// Remove remember me cookie
setcookie("remember_me", "", time() - 3600, "/"); // Expire the cookie

// Redirect to login page
header("Location: ../index.php");
exit();
?>
