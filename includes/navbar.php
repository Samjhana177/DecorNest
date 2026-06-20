<?php
/* ====================================================
   FILE: includes/navbar.php
   PURPOSE: The responsive navigation bar shown at the
   top of every page. Includes the logo, menu links,
   and Login / Register buttons.
==================================================== */
?>
<!-- ===== NAVBAR START ===== -->
<nav class="navbar navbar-expand-lg dn-navbar sticky-top">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand dn-brand" href="index.php">
      <img src="assets/images/logo.png" alt="DecorNest Logo" class="dn-logo-img">
      DecorNest
    </a>

    <!-- Hamburger button (shows on mobile) -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#dnNavbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible menu -->
    <div class="collapse navbar-collapse" id="dnNavbarMenu">

      <!-- Menu links -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>

        <!-- Login link -->
        <li class="nav-item ms-lg-2">
          <a class="nav-link" href="login.php">Login</a>
        </li>

        <!-- Register button -->
        <li class="nav-item ms-lg-2">
          <a class="btn dn-btn-register" href="register.php">Register</a>
        </li>
      </ul>

    </div>
  </div>
</nav>
<!-- ===== NAVBAR END ===== -->