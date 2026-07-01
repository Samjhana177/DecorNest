/* ====================================================
   FILE: assets/js/product-details.js
   PURPOSE: Handles the quantity +/- buttons on the
   product-details.php page.

   HOW IT WORKS:
   - The quantity input starts at 1.
   - Clicking + reads the current number, adds 1,
     and writes the new number back into the input.
   - Clicking - reads the current number, subtracts 1,
     but only if the result is still at least 1.
   - The input is readonly so the user can only change
     the number through these two buttons.
   - When the form is submitted, the current value
     inside the input is sent automatically because
     the input has name="quantity".

   NO AJAX. NO JQUERY. NO COMPLEX CODE.
==================================================== */

document.addEventListener("DOMContentLoaded", function () {

  /* --------------------------------------------------
     Step 1: Get the three elements we need.
     - qtyInput  : the number box that shows the value
     - minusBtn  : the "-" button
     - plusBtn   : the "+" button
  -------------------------------------------------- */
  var qtyInput = document.getElementById("quantity");
  var minusBtn = document.getElementById("qtyMinus");
  var plusBtn  = document.getElementById("qtyPlus");

  /* --------------------------------------------------
     Step 2: Safety check - if any of the three
     elements is missing, stop here.
     (Prevents errors if this file is loaded on a page
     that doesn't have these elements.)
  -------------------------------------------------- */
  if (!qtyInput || !minusBtn || !plusBtn) {
    return;
  }

  /* --------------------------------------------------
     Step 3: Set the minimum and maximum allowed values.
     These match the min="1" and max="10" attributes
     already on the input in product-details.php.
  -------------------------------------------------- */
  var MIN_QUANTITY = 1;
  var MAX_QUANTITY = 10;

  /* --------------------------------------------------
     Step 4: MINUS button click
     Read the current value, subtract 1, write it back.
     Only subtract if the result would still be >= 1.
  -------------------------------------------------- */
  minusBtn.addEventListener("click", function () {

    let current = Number(qtyInput.value);

    if (current > 1) {
        qtyInput.value = current - 1;
    }

    updateButtons();
});

plusBtn.addEventListener("click", function () {

    let current = Number(qtyInput.value);

    if (current < 10) {
        qtyInput.value = current + 1;
    }

    updateButtons();
});
  /* --------------------------------------------------
     Step 6: updateButtons()
     Visually disables the minus button when quantity
     is at 1, and the plus button when it is at 10.
     This gives the user a clear signal that they have
     reached the limit.
  -------------------------------------------------- */
  function updateButtons() {

    let current = Number(qtyInput.value);

    minusBtn.disabled = (current <= 1);
    plusBtn.disabled = (current >= 10);
}
  /* --------------------------------------------------
     Step 7: Run updateButtons() once immediately when
     the page loads, so the minus button starts
     disabled (since the starting value is already 1).
  -------------------------------------------------- */
  updateButtons();

});