<?php
/* ====================================================
   FILE: includes/header.php
   PURPOSE: Opens the HTML document, loads meta tags,
   Bootstrap CSS, Bootstrap Icons, and our custom CSS.
   Included at the TOP of every page.

   IMPORTANT: This file must be included AFTER the page
   sets $extraCss (if it needs page-specific CSS like
   assets/css/products.css). See products.php for an
   example: it sets $extraCss BEFORE including this file.
==================================================== */
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DecorNest - Home Decor & Furniture</title>

  <!-- Bootstrap 5 CSS (CDN) -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet">

  <!-- Bootstrap Icons (CDN) -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Google Font for headings (optional but gives a premium look) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Our own custom CSS file (shared across the whole site) -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- ====================================================
       PAGE-SPECIFIC CSS
       If a page sets $extraCss = ['assets/css/products.css'];
       BEFORE including this header.php, that stylesheet
       gets printed here too. This is how products.php,
       product-details.php, and cart.php load products.css
       in addition to the shared style.css above.
  ==================================================== -->
  <?php if (!empty($extraCss)): ?>
    <?php foreach ($extraCss as $cssFile): ?>
      <link rel="stylesheet" href="<?php echo htmlspecialchars($cssFile); ?>">
    <?php endforeach; ?>
  <?php endif; ?>

</head>
<body>