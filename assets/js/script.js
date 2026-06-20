/* ----------------------------------------------------
   1. Wait until the page has fully loaded
---------------------------------------------------- */
document.addEventListener("DOMContentLoaded", function () {

  /* --------------------------------------------------
     2. Newsletter form - simple "Subscribed!" message
     (No backend yet, so we just show an alert)
  -------------------------------------------------- */
  const newsletterForm = document.querySelector(".dn-newsletter-form");

  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      e.preventDefault(); // stop the form from reloading the page

      const emailInput = newsletterForm.querySelector("input[type='email']");
      const email = emailInput.value.trim();

      if (email !== "") {
        alert("Thank you for subscribing with: " + email);
        emailInput.value = ""; // clear the input box
      }
    });
  }


  /* --------------------------------------------------
     3. Navbar shadow effect when user scrolls down
     (Gives a nice "sticky" premium feel)
  -------------------------------------------------- */
  const navbar = document.querySelector(".dn-navbar");

  if (navbar) {
    window.addEventListener("scroll", function () {
      if (window.scrollY > 30) {
        navbar.style.boxShadow = "0 4px 18px rgba(0, 0, 0, 0.12)";
      } else {
        navbar.style.boxShadow = "0 2px 12px rgba(0, 0, 0, 0.06)";
      }
    });
  }


  /* --------------------------------------------------
     4. Auto-close mobile menu after clicking a link
     (Improves mobile user experience)
  -------------------------------------------------- */
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link, .dn-btn-register");
  const mobileMenu = document.querySelector("#dnNavbarMenu");

  navLinks.forEach(function (link) {
    link.addEventListener("click", function () {
      if (mobileMenu.classList.contains("show")) {
        const bsCollapse = new bootstrap.Collapse(mobileMenu);
        bsCollapse.hide();
      }
    });
  });

});