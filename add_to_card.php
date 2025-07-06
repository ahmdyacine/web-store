<?php
session_start();

// Check if a product_id is sent via POST
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Initialize the cart if not already done
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If the product is already in the cart, increase quantity
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        // Otherwise, add it to the cart with quantity 1
        $_SESSION['cart'][$productId] = 1;
    }

    // Redirect back to the shop or previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "No product selected.";
}
?>
