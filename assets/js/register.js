/* ====================================================
   FILE: assets/js/register.js
   PURPOSE: Simple client-side validation and small
   interactions for register.php.

   WHAT THIS FILE DOES:
   1. Checks required fields are filled before submit.
   2. Checks the email looks valid.
   3. Checks password is at least 6 characters.
   4. Checks Confirm Password matches Password.
   5. Shows/hides password text with the eye icon.
   6. Shows a password strength bar as the user types.
   7. Disables the Register button while submitting
      (so the user can't click it twice).

   NOTE: This is CLIENT-SIDE validation only - it makes
   the form nicer to use, but PHP still validates
   everything again on the server (in register.php),
   which is the real security check.
==================================================== */

document.addEventListener("DOMContentLoaded", function () {

  const form         = document.getElementById("registerForm");
  const registerBtn  = document.getElementById("registerBtn");

  // Grab all the input fields we need to check
  const fullNameInput = document.getElementById("full_name");
  const emailInput     = document.getElementById("email");
  const phoneInput     = document.getElementById("phone");
  const addressInput   = document.getElementById("address");
  const passwordInput  = document.getElementById("password");
  const confirmInput   = document.getElementById("confirm_password");

  // Grab the small error text elements below each field
  const fullNameError = document.getElementById("full_name_error");
  const emailError     = document.getElementById("email_error");
  const phoneError     = document.getElementById("phone_error");
  const addressError   = document.getElementById("address_error");
  const passwordError  = document.getElementById("password_error");
  const confirmError   = document.getElementById("confirm_password_error");

  /* --------------------------------------------------
     1. SHOW / HIDE PASSWORD
     Works for both the password and confirm password
     fields using the data-target attribute.
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
     2. PASSWORD STRENGTH INDICATOR
     Checks the password as the user types and shows
     a colored bar: weak / medium / strong.
  -------------------------------------------------- */
  const strengthFill = document.getElementById("strengthFill");
  const strengthText = document.getElementById("strengthText");

  passwordInput.addEventListener("input", function () {

    const password = passwordInput.value;
    let strength    = 0;

    // Add points based on what the password contains
    if (password.length >= 6)               strength++;
    if (password.length >= 10)               strength++;
    if (/[A-Z]/.test(password))              strength++; // has uppercase
    if (/[0-9]/.test(password))              strength++; // has a number
    if (/[^A-Za-z0-9]/.test(password))       strength++; // has a symbol

    // Reset classes first
    strengthFill.classList.remove("weak", "medium", "strong");

    if (password.length === 0) {
      strengthFill.style.width = "0%";
      strengthText.textContent = "Password strength";

    } else if (strength <= 2) {
      strengthFill.style.width = "33%";
      strengthFill.classList.add("weak");
      strengthText.textContent = "Weak password";

    } else if (strength <= 4) {
      strengthFill.style.width = "66%";
      strengthFill.classList.add("medium");
      strengthText.textContent = "Medium strength";

    } else {
      strengthFill.style.width = "100%";
      strengthFill.classList.add("strong");
      strengthText.textContent = "Strong password";
    }
  });


  /* --------------------------------------------------
     3. HELPER FUNCTION: show an error message under
     a field and add the red error border style.
  -------------------------------------------------- */
  function showError(inputElement, errorElement, message) {
    inputElement.classList.add("dn-input-error");
    errorElement.textContent = message;
  }

  // Helper function: clear an error message
  function clearError(inputElement, errorElement) {
    inputElement.classList.remove("dn-input-error");
    errorElement.textContent = "";
  }


  /* --------------------------------------------------
     4. FORM SUBMIT VALIDATION
     Runs all checks when the user clicks Register.
     If anything is wrong, we stop the form from
     submitting and show the error messages.
  -------------------------------------------------- */
  form.addEventListener("submit", function (event) {

    let isValid = true; // we'll set this to false if any check fails

    // ---------- Check Full Name ----------
    if (fullNameInput.value.trim() === "") {
      showError(fullNameInput, fullNameError, "Full name is required.");
      isValid = false;
    } else {
      clearError(fullNameInput, fullNameError);
    }

    // ---------- Check Email ----------
    const emailValue = emailInput.value.trim();
    // Simple email pattern: something@something.something
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

    // ---------- Check Phone ----------
    if (phoneInput.value.trim() === "") {
      showError(phoneInput, phoneError, "Phone number is required.");
      isValid = false;
    } else {
      clearError(phoneInput, phoneError);
    }

    // ---------- Check Address ----------
    if (addressInput.value.trim() === "") {
      showError(addressInput, addressError, "Address is required.");
      isValid = false;
    } else {
      clearError(addressInput, addressError);
    }

    // ---------- Check Password ----------
    if (passwordInput.value === "") {
      showError(passwordInput, passwordError, "Password is required.");
      isValid = false;
    } else if (passwordInput.value.length < 6) {
      showError(passwordInput, passwordError, "Password must be at least 6 characters.");
      isValid = false;
    } else {
      clearError(passwordInput, passwordError);
    }

    // ---------- Check Confirm Password ----------
    if (confirmInput.value === "") {
      showError(confirmInput, confirmError, "Please confirm your password.");
      isValid = false;
    } else if (confirmInput.value !== passwordInput.value) {
      showError(confirmInput, confirmError, "Passwords do not match.");
      isValid = false;
    } else {
      clearError(confirmInput, confirmError);
    }

    // ---------- Stop submission if anything failed ----------
    if (!isValid) {
      event.preventDefault();
      return;
    }

    // ---------- 5. Disable the button while submitting ----------
    // This prevents the user from clicking Register twice
    // and accidentally creating two accounts.
    registerBtn.disabled = true;
    registerBtn.textContent = "Creating account...";
  });

});