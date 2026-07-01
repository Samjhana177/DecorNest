<?php
/* ====================================================
   FILE: remove-cart.php
   PURPOSE: Removes one product from the session cart
   and redirects back to cart.php.
==================================================== */

session_start();

// Check if an id was sent
if (isset($_GET['id'])) {

    // Convert to integer for safety
    $productId = (int) $_GET['id'];

    // Check if the cart exists and the product is inside it
    if (isset($_SESSION['cart'][$productId])) {

        // Remove the product
        unset($_SESSION['cart'][$productId]);
    }
}

// Go back to the cart page
header("Location: cart.php");
exit;