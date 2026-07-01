<?php
/* ====================================================
   FILE: add-to-cart.php
   PURPOSE: Receives a product id (and quantity) from
   a form submission, checks if the user is logged in,
   and stores the product in the SESSION cart.

   FLOW (as required):
   User clicks "Add to Cart"
        ↓
   add-to-cart.php (THIS FILE)
        ↓
   Check login -> if not logged in, redirect to login.php
        ↓
   Store product id in $_SESSION['cart']
        ↓
   Redirect to cart.php
==================================================== */

include 'includes/auth.php'; // gives us isLoggedIn() and starts the session

/* ----------------------------------------------------
   STEP 1: Require login BEFORE doing anything else.
   If not logged in, requireLogin() redirects to
   login.php and stops the script immediately.
---------------------------------------------------- */
requireLogin();

/* ----------------------------------------------------
   STEP 2: Make sure this was a real form submission
   and a product_id was actually sent.
---------------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {

    $productId = (int) $_POST['product_id'];

    // Quantity is optional - if not sent, default to 1
    $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;
    if ($quantity < 1) {
        $quantity = 1;
    }

    /* --------------------------------------------------
       STEP 3: Make sure the cart array exists in the
       session. If this is the user's first time adding
       a product, $_SESSION['cart'] won't exist yet.
    -------------------------------------------------- */
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    /* --------------------------------------------------
       STEP 4: If this product is ALREADY in the cart,
       just increase its quantity instead of adding a
       duplicate entry.
    -------------------------------------------------- */
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = $quantity;
    }

    /* --------------------------------------------------
       Cart structure example:
       $_SESSION['cart'] = [
           5  => 2,   // product id 5, quantity 2
           12 => 1,   // product id 12, quantity 1
       ];
    -------------------------------------------------- */
}

/* ----------------------------------------------------
   STEP 5: Redirect the user to the cart page so they
   can see what they just added.
---------------------------------------------------- */
header('Location: cart.php');
exit;