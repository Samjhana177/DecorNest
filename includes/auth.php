<?php
/* ====================================================
   FILE: includes/auth.php
   PURPOSE: Simple helper functions to check if a user
   is logged in. Used mainly by add-to-cart.php to make
   sure only logged-in users can add products to cart.

   NOTE: This is a SIMPLE session-based check.
   login.php / register.php are not built yet in this
   task, but this file expects that once a user logs
   in, login.php will set:

      $_SESSION['user_id']  = the logged in user's id
      $_SESSION['username'] = the logged in user's name

   Until login.php exists, isLoggedIn() will always
   return false, which is the SAFE default.
==================================================== */

// Start the session if it hasn't been started already.
// session_start() must run before ANY HTML output.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ----------------------------------------------------
   isLoggedIn()
   Returns TRUE if a user is currently logged in,
   FALSE otherwise.
---------------------------------------------------- */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/* ----------------------------------------------------
   requireLogin()
   If the user is NOT logged in, redirect them to the
   login page immediately and stop the script.
   Used inside add-to-cart.php before adding any item.
---------------------------------------------------- */
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}