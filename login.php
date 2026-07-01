<?php
/* ====================================================
   FILE: login.php
   PURPOSE: Lets an existing user log into their account.

   FLOW:
   1. Page loads -> shows the login form.
   2. User submits email + password (POST request).
   3. PHP looks up the user by email.
   4. PHP checks the password using password_verify().
   5. If correct, PHP creates session variables and
      redirects based on the user's role.
   6. If wrong, shows a Bootstrap error alert.
==================================================== */

// session_start() must run before ANY HTML is printed
session_start();

require_once 'config/database.php';

$errorMessage = '';
$email        = ''; // keep typed email if login fails

/* ----------------------------------------------------
   Only run this block when the form is submitted
---------------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ---------- STEP 1: Get the form values ----------
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // ---------- STEP 2: Validate required fields ----------
    if ($email === '' || $password === '') {

        $errorMessage = 'Please enter both email and password.';

    } else {

        // ---------- STEP 3: Look up the user by email ----------
        $safeEmail = mysqli_real_escape_string($conn, $email);
        $query     = "SELECT * FROM users WHERE email = '$safeEmail'";
        $result    = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {

            // Get the user's data as an array
            $user = mysqli_fetch_assoc($result);

            // ---------- STEP 4: Check the password ----------
            // password_verify() compares the typed password
            // against the hashed password stored in the database.
            if (password_verify($password, $user['password'])) {

                // ---------- STEP 5: Login successful - create session ----------
                $_SESSION['user_id']   = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];

                // ---------- STEP 6: Redirect based on role ----------
                if ($user['role'] === 'admin') {
                    header('Location: admin/dashboard.php');
                } else {
                    header('Location: index.php');
                }
                exit; // always exit after a header redirect

            } else {
                // Password did not match
                $errorMessage = 'Incorrect email or password.';
            }

        } else {
            // No user found with that email
            $errorMessage = 'Incorrect email or password.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - DecorNest</title>

  <!-- Bootstrap 5 CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons (CDN) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Shared site CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Login page CSS -->
  <link rel="stylesheet" href="assets/css/login.css">

</head>
<body class="dn-auth-body">

<!-- =========================================================
     LOGIN PAGE CONTENT
========================================================= -->
<div class="dn-auth-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">

        <div class="dn-auth-card">

          <!-- Logo / Brand -->
          <div class="dn-auth-brand">
            <i class="bi bi-house-heart-fill"></i>
            <span>DecorNest</span>
          </div>

          <h3 class="dn-auth-title">Welcome Back</h3>
          <p class="dn-auth-subtitle">Login to continue shopping for your home</p>

          <!-- ---------- Bootstrap Alert ---------- -->
          <?php if ($errorMessage !== ''): ?>
            <div class="alert alert-danger" role="alert">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <?php echo htmlspecialchars($errorMessage); ?>
            </div>
          <?php endif; ?>

          <!-- ---------- Login Form ---------- -->
          <form method="POST" action="login.php" id="loginForm" novalidate>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input
                type="email"
                class="form-control dn-input"
                id="email"
                name="email"
                placeholder="Enter your email"
                value="<?php echo htmlspecialchars($email); ?>">
              <small class="dn-error-text" id="email_error"></small>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="dn-password-wrap">
                <input
                  type="password"
                  class="form-control dn-input"
                  id="password"
                  name="password"
                  placeholder="Enter your password">
                <button type="button" class="dn-toggle-password" data-target="password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <small class="dn-error-text" id="password_error"></small>
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-3 dn-auth-options">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label" for="rememberMe">
                  Remember Me
                </label>
              </div>
              <a href="#" class="dn-forgot-link">Forgot Password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn dn-btn-auth w-100" id="loginBtn">
              Login
            </button>

          </form>

          <p class="dn-auth-footer-text">
            Don't have an account? <a href="register.php">Register</a>
          </p>

        </div>

      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Login page JS -->
<script src="assets/js/login.js"></script>

</body>
</html>