<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to home page
header("Location: Home.php"); 
exit();
?>
