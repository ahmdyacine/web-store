<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystoredb";

try {
    // Create connection and assign to $conn
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


?>
