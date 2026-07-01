<?php
/* ====================================================
   FILE: logout.php
   PURPOSE: Logs the user out by destroying their
   session, then sends them back to the login page.
==================================================== */

// Start the session so we can access and destroy it
session_start();

// Remove all session variables
session_unset();

// Destroy the session completely
session_destroy();

// Send the user back to the login page
header("Location: index.php");
exit;