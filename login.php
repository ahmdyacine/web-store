<?php
include 'mydb.php'; // Should define $servername, $dbname, $dbUsername, $dbPassword
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    try {
        // Use DB credentials from your config
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch user by username
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $usernameInput);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($passwordInput, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: Home.php"); // Redirect to the home page after successful login
            exit();
        } else {
            echo "<script>alert('❌ Invalid username or password.');</script>";
        }

    } catch (PDOException $e) {
        echo "❌ Error: " . $e->getMessage();
    }

    $conn = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="new.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <title>Login Page</title>
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="header">

        <img src="shop-logo-removebg-preview.png" alt="logo">
      
       <div class="search">
        <input placeholder="Search for brand or type" />

         <button><span class="material-symbols-outlined">
           search
           </span></button>
       </div>
       <div class="menu">
           <a href="Home.php">home</a>
           <a href="#">shop</a>
           <a href="#">about</a>
           <a href="login.php">LOG IN</a>
           
       </div>
    </div>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <div class="form-group">
                <p>Don't have an account? <a href="registerPage.html">Register here</a></p>
            </form>
</div>
        </div>
    </div>
    <footer>
        <p>&copy; 2025 Your footwear store. All rights reserved.</p>
    </footer>
</body>
</html>

