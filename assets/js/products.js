document.addEventListener("DOMContentLoaded", function () {

  const cartButtons = document.querySelectorAll(".dn-btn-cart, .dn-add-cart-big");

  cartButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      btn.classList.add("dn-pop");
      setTimeout(function () {
        btn.classList.remove("dn-pop");
      }, 200);
    });
  });


  const qtyInput  = document.getElementById("quantity");
  const qtyMinus  = document.getElementById("qtyMinus");
  const qtyPlus   = document.getElementById("qtyPlus");

  if (qtyInput && qtyMinus && qtyPlus) {

    qtyMinus.addEventListener("click", function () {
      let current = parseInt(qtyInput.value);
      if (current > 1) {
        qtyInput.value = current - 1;
      }
    });

    qtyPlus.addEventListener("click", function () {
      let current = parseInt(qtyInput.value);
      if (current < 10) {
        qtyInput.value = current + 1;
      }
    });
  }

  function showToast(message) {
    const toast = document.createElement("div");
    toast.className = "dn-toast";
    toast.textContent = message;
    document.body.appendChild(toast);

    // trigger the fade-in animation
    setTimeout(function () {
      toast.classList.add("show");
    }, 50);

    // remove the toast after 2.5 seconds
    setTimeout(function () {
      toast.classList.remove("show");
      setTimeout(function () {
        toast.remove();
      }, 300);
    }, 2500);
  }

  const params = new URLSearchParams(window.location.search);
  if (params.get("added") === "1") {
    showToast("Item added to cart!");
  }

});