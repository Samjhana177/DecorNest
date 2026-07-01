<?php
/* ====================================================
   FILE: config/database.php
   PURPOSE: Creates ONE reusable database connection
   that every other page can use by simply writing:

      require_once 'config/database.php';

   After that, the variable $conn is available and
   ready to use for queries like mysqli_query($conn, ...)

   DATABASE SETTINGS (XAMPP defaults):
   - Host:     localhost
   - Username: root
   - Password: (empty)
   - Database: decornest
==================================================== */

// ---------- Database connection settings ----------
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'decornest';

// ---------- Create the connection using MySQLi ----------
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// ---------- Check if the connection failed ----------
if (!$conn) {
    // Stop the page and show a friendly error message
    // instead of a scary raw PHP error.
    die(
        '<div style="font-family:Arial, sans-serif; max-width:600px; margin:60px auto; ' .
        'padding:24px; background:#fdecea; border:1px solid #f5c6cb; border-radius:10px; ' .
        'color:#721c24; text-align:center;">' .
        '<h3>Database Connection Failed</h3>' .
        '<p>We could not connect to the DecorNest database. ' .
        'Please make sure:</p>' .
        '<ul style="text-align:left; display:inline-block;">' .
        '<li>XAMPP MySQL is started (green light)</li>' .
        '<li>A database named <b>decornest</b> exists in phpMyAdmin</li>' .
        '<li>The "users" table has been created</li>' .
        '</ul></div>'
    );
}

// ---------- Set character set to support all text properly ----------
mysqli_set_charset($conn, 'utf8mb4');

/* ----------------------------------------------------
   NOTE: We do NOT close the connection here.
   PHP automatically closes it when the page finishes
   loading, so every page that includes this file can
   freely use $conn until the end of that page.
---------------------------------------------------- */