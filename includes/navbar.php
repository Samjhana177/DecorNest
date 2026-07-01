<?php
/* ====================================================
   FILE: includes/navbar.php
   PURPOSE: Responsive navigation bar shown on every
   page. The menu links change based on whether the
   user is logged out, logged in as a customer, or
   logged in as an admin.

   IMPORTANT: This file checks $_SESSION['user_role'],
   so session_start() must already have been called
   before this file is included (login.php, logout.php,
   and any page using sessions should call it first).
==================================================== */

// Make sure the session is started so we can read it.
// (safe to call again even if already started elsewhere)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Figure out if someone is logged in, and what role they have
$isLoggedIn = isset($_SESSION['user_id']);
$userRole   = $isLoggedIn ? $_SESSION['user_role'] : null;
$userName   = $isLoggedIn ? $_SESSION['user_name'] : '';
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
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">

        <?php if (!$isLoggedIn): ?>

          <!-- ============================================
               MENU FOR GUESTS (not logged in)
          ============================================ -->
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
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
          <li class="nav-item ms-lg-2">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item ms-lg-2">
            <a class="btn dn-btn-register" href="register.php">Register</a>
          </li>

        <?php elseif ($userRole === 'admin'): ?>

          <!-- ============================================
               MENU FOR ADMIN
          ============================================ -->
          <li class="nav-item">
            <a class="nav-link" href="admin/dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/categories.php">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/users.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/orders.php">Orders</a>
          </li>
          <li class="nav-item ms-lg-2">
            <span class="nav-link dn-welcome-text">
              <i class="bi bi-person-fill"></i> <?php echo htmlspecialchars($userName); ?>
            </span>
          </li>
          <li class="nav-item ms-lg-2">
            <a class="btn dn-btn-register" href="logout.php">Logout</a>
          </li>

        <?php else: ?>

          <!-- ============================================
               MENU FOR LOGGED-IN CUSTOMER
          ============================================ -->
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link dn-cart-link" href="cart.php">
              <i class="bi bi-cart3"></i> Cart
            </a>
          </li>
          <li class="nav-item ms-lg-2">
            <span class="nav-link dn-welcome-text">
              <i class="bi bi-person-fill"></i> <?php echo htmlspecialchars($userName); ?>
            </span>
          </li>
          <li class="nav-item ms-lg-2">
            <a class="btn dn-btn-register" href="logout.php">Logout</a>
          </li>

        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>
<!-- ===== NAVBAR END ===== -->