<?php
require 'mydb.php'; // make sure this file exists and doesn't close the connection
session_start();

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="new.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
        <title>footwear.home</title>
    </head>
    <body>
     <div class="header">

         <img src="shop-logo-removebg-preview.png" alt="logo">
        <form action="search.php" method="get">
        <div class="search">
          <input placeholder=" search for brand or type "; />
          <button><span class="material-symbols-outlined">
            search
            </span></button>
        </div>
        </form> 
        <div class="menu">
            <a href="Home.php">home</a>
            <a href="#">shop</a>
            <a href="#">about</a>
            <?php if (isset($_SESSION['user_id'])): ?>
    <a href="logout.php">Logout</a>
  <?php else: ?>
    <a href="login.php">Login</a>
  <?php endif; ?>
</div>

     </div>

     <!--Trending-->
    <h1>Trending</h1>
    <div class="trending">
<?php
// Sample data for products
$count = 0;
?>

<?php foreach ($products as $index => $product): ?>

  <?php if ($count % 4 == 0): ?>
    <div class="products"> <!-- Start of row -->
  <?php endif; ?>

  <div class="card">
    <img src="<?php echo $product['image']; ?>" alt="product image">
    <h3><?php echo $product['name']; ?></h3>
    <div class="price">
    <button onclick="buyNow(
  '<?php echo addslashes($product['name']); ?>',
  '<?php echo $product['price']; ?>',
  '<?php echo $product['image']; ?>'
)">Buy Now</button>

    </div>
  </div>

  <?php $count++; ?>

  <?php if ($count % 4 == 0 || $count == count($products)): ?>
    </div> <!-- End of row -->
  <?php endif; ?>

<?php endforeach; ?>

       
    </div>
    <script>
    function buyNow(name, price, image) {
        localStorage.setItem('productName', name);
        localStorage.setItem('productPrice', price);
        localStorage.setItem('productImage', image);
        window.location.href = 'checkout.html';
    }
</script>
    </body>
    <footer>
        <p>&copy; 2025 Your footwear store. All rights reserved.</p>
    </footer>
</html>
