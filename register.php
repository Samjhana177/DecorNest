<?php
/* ====================================================
   FILE: register.php
   PURPOSE: Lets a new customer create an account.

   FLOW:
   1. Page loads -> shows the registration form.
   2. User submits the form (POST request).
   3. PHP validates every field.
   4. PHP checks if the email is already used.
   5. PHP hashes the password and inserts the new user.
   6. Shows a success or error Bootstrap alert.
==================================================== */

require_once 'config/database.php';

// These will hold any messages we want to show the user
$successMessage = '';
$errorMessage   = '';

// Keep whatever the user typed so the form doesn't
// clear out if something goes wrong (better experience)
$fullName = '';
$email    = '';
$phone    = '';
$address  = '';

/* ----------------------------------------------------
   Only run this block when the form is submitted
   (i.e. when the request method is POST)
---------------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ---------- STEP 1: Get and clean the form values ----------
    $fullName        = trim($_POST['full_name']);
    $email           = trim($_POST['email']);
    $phone           = trim($_POST['phone']);
    $address         = trim($_POST['address']);
    $password        = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // ---------- STEP 2: Validate required fields ----------
    if ($fullName === '' || $email === '' || $phone === '' ||
        $address === '' || $password === '' || $confirmPassword === '') {

        $errorMessage = 'Please fill in all fields.';

    // ---------- STEP 3: Validate email format ----------
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $errorMessage = 'Please enter a valid email address.';

    // ---------- STEP 4: Validate password length ----------
    } elseif (strlen($password) < 6) {

        $errorMessage = 'Password must be at least 6 characters long.';

    // ---------- STEP 5: Validate password match ----------
    } elseif ($password !== $confirmPassword) {

        $errorMessage = 'Password and Confirm Password do not match.';

    // ---------- STEP 6: All basic checks passed, now check the database ----------
    } else {

        // Check if this email is already registered.
        // We use real_escape_string() to keep the query safe.
        $safeEmail   = mysqli_real_escape_string($conn, $email);
        $checkQuery  = "SELECT id FROM users WHERE email = '$safeEmail'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {

            // An account with this email already exists
            $errorMessage = 'An account with this email already exists. Please login instead.';

        } else {

            // ---------- STEP 7: Hash the password before saving ----------
            // NEVER store plain text passwords in the database.
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // ---------- STEP 8: Prepare safe values for the INSERT query ----------
            $safeFullName = mysqli_real_escape_string($conn, $fullName);
            $safePhone    = mysqli_real_escape_string($conn, $phone);
            $safeAddress  = mysqli_real_escape_string($conn, $address);

            // ---------- STEP 9: Insert the new user (role is always 'customer') ----------
            $insertQuery = "INSERT INTO users (full_name, email, phone, address, password, role)
                            VALUES ('$safeFullName', '$safeEmail', '$safePhone', '$safeAddress', '$hashedPassword', 'customer')";

            if (mysqli_query($conn, $insertQuery)) {

                $successMessage = 'Registration successful! Redirecting you to login...';

                // Clear the form fields after a successful registration
                $fullName = '';
                $email    = '';
                $phone    = '';
                $address  = '';

            } else {
                $errorMessage = 'Something went wrong while creating your account. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - DecorNest</title>

  <!-- Bootstrap 5 CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons (CDN) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Shared site CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- Register page CSS -->
  <link rel="stylesheet" href="assets/css/register.css">

</head>
<body class="dn-auth-body">

<!-- =========================================================
     REGISTER PAGE CONTENT
========================================================= -->
<div class="dn-auth-wrapper">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">

        <div class="dn-auth-card">

          <!-- Logo / Brand -->
          <div class="dn-auth-brand">
            <i class="bi bi-house-heart-fill"></i>
            <span>DecorNest</span>
          </div>

          <h3 class="dn-auth-title">Create Your Account</h3>
          <p class="dn-auth-subtitle">Join DecorNest and start decorating your dream home</p>

          <!-- ---------- Bootstrap Alerts ---------- -->
          <?php if ($successMessage !== ''): ?>
            <div class="alert alert-success" role="alert">
              <i class="bi bi-check-circle-fill"></i>
              <?php echo htmlspecialchars($successMessage); ?>
            </div>
          <?php endif; ?>

          <?php if ($errorMessage !== ''): ?>
            <div class="alert alert-danger" role="alert">
              <i class="bi bi-exclamation-triangle-fill"></i>
              <?php echo htmlspecialchars($errorMessage); ?>
            </div>
          <?php endif; ?>

          <!-- ---------- Registration Form ---------- -->
          <form method="POST" action="register.php" id="registerForm" novalidate>

            <!-- Full Name -->
            <div class="mb-3">
              <label for="full_name" class="form-label">Full Name</label>
              <input
                type="text"
                class="form-control dn-input"
                id="full_name"
                name="full_name"
                placeholder="Enter your full name"
                value="<?php echo htmlspecialchars($fullName); ?>">
              <small class="dn-error-text" id="full_name_error"></small>
            </div>

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

            <!-- Phone -->
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input
                type="text"
                class="form-control dn-input"
                id="phone"
                name="phone"
                placeholder="Enter your phone number"
                value="<?php echo htmlspecialchars($phone); ?>">
              <small class="dn-error-text" id="phone_error"></small>
            </div>

            <!-- Address -->
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input
                type="text"
                class="form-control dn-input"
                id="address"
                name="address"
                placeholder="Enter your address"
                value="<?php echo htmlspecialchars($address); ?>">
              <small class="dn-error-text" id="address_error"></small>
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
                  placeholder="Create a password">
                <button type="button" class="dn-toggle-password" data-target="password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <!-- Password strength indicator -->
              <div class="dn-strength-bar">
                <div class="dn-strength-fill" id="strengthFill"></div>
              </div>
              <small class="dn-strength-text" id="strengthText">Password strength</small>
              <small class="dn-error-text" id="password_error"></small>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <div class="dn-password-wrap">
                <input
                  type="password"
                  class="form-control dn-input"
                  id="confirm_password"
                  name="confirm_password"
                  placeholder="Re-enter your password">
                <button type="button" class="dn-toggle-password" data-target="confirm_password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <small class="dn-error-text" id="confirm_password_error"></small>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn dn-btn-auth w-100" id="registerBtn">
              Register
            </button>

          </form>

          <p class="dn-auth-footer-text">
            Already have an account? <a href="login.php">Login</a>
          </p>

        </div>

      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Register page JS -->
<script src="assets/js/register.js"></script>

<?php if ($successMessage !== ''): ?>
<!-- Redirect to login.php after 2 seconds on successful registration -->
<script>
  setTimeout(function () {
    window.location.href = 'login.php';
  }, 2000);
</script>
<?php endif; ?>

</body>
</html>