/* ====================================================
   FILE: assets/js/login.js
   PURPOSE: Simple client-side validation and small
   interactions for login.php.

   WHAT THIS FILE DOES:
   1. Checks email and password are filled before submit.
   2. Checks the email looks valid.
   3. Shows/hides the password text with the eye icon.
   4. Disables the Login button while submitting (so the
      user can't click it twice).

   NOTE: This is CLIENT-SIDE validation only - PHP still
   checks the email and password again on the server in
   login.php, which is the real security check.
==================================================== */

document.addEventListener("DOMContentLoaded", function () {

  const form     = document.getElementById("loginForm");
  const loginBtn = document.getElementById("loginBtn");

  const emailInput    = document.getElementById("email");
  const passwordInput = document.getElementById("password");

  const emailError    = document.getElementById("email_error");
  const passwordError = document.getElementById("password_error");

  /* --------------------------------------------------
     1. SHOW / HIDE PASSWORD
  -------------------------------------------------- */
  const toggleButtons = document.querySelectorAll(".dn-toggle-password");

  toggleButtons.forEach(function (button) {
    button.addEventListener("click", function () {

      const targetId    = button.getAttribute("data-target");
      const targetInput = document.getElementById(targetId);
      const icon        = button.querySelector("i");

      if (targetInput.type === "password") {
        targetInput.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      } else {
        targetInput.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      }
    });
  });


  /* --------------------------------------------------
     2. HELPER FUNCTIONS for showing/clearing errors
  -------------------------------------------------- */
  function showError(inputElement, errorElement, message) {
    inputElement.classList.add("dn-input-error");
    errorElement.textContent = message;
  }

  function clearError(inputElement, errorElement) {
    inputElement.classList.remove("dn-input-error");
    errorElement.textContent = "";
  }


  /* --------------------------------------------------
     3. FORM SUBMIT VALIDATION
  -------------------------------------------------- */
  form.addEventListener("submit", function (event) {

    let isValid = true;

    // ---------- Check Email ----------
    const emailValue   = emailInput.value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailValue === "") {
      showError(emailInput, emailError, "Email is required.");
      isValid = false;
    } else if (!emailPattern.test(emailValue)) {
      showError(emailInput, emailError, "Please enter a valid email address.");
      isValid = false;
    } else {
      clearError(emailInput, emailError);
    }

    // ---------- Check Password ----------
    if (passwordInput.value === "") {
      showError(passwordInput, passwordError, "Password is required.");
      isValid = false;
    } else {
      clearError(passwordInput, passwordError);
    }

    // ---------- Stop submission if anything failed ----------
    if (!isValid) {
      event.preventDefault();
      return;
    }

    // ---------- 4. Disable the button while submitting ----------
    loginBtn.disabled = true;
    loginBtn.textContent = "Logging in...";
  });

});