<?php

?>

<footer class="dn-footer">
  <div class="container">
    <div class="row gy-4">

      <!-- About column -->
      <div class="col-md-4">
        <h5 class="dn-footer-heading">DecorNest</h5>
        <p class="dn-footer-text">
          DecorNest brings premium home decor and furniture to your
          doorstep. We help you transform every room into a beautiful,
          comfortable, and stylish living space.
        </p>
      </div>

      <!-- Quick Links column -->
      <div class="col-md-4">
        <h5 class="dn-footer-heading">Quick Links</h5>
        <ul class="dn-footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="about.php">About Us</a></li>
          <li><a href="contact.php">Contact Us</a></li>
        </ul>
      </div>

      <!-- Contact column -->
      <div class="col-md-4">
        <h5 class="dn-footer-heading">Contact Us</h5>
        <ul class="dn-footer-links">
          <li><i class="bi bi-geo-alt-fill"></i> Kathmandu, Nepal</li>
          <li><i class="bi bi-telephone-fill"></i> +977 9800000000</li>
          <li><i class="bi bi-envelope-fill"></i> info@decornest.com</li>
        </ul>
      </div>

    </div>

    <hr class="dn-footer-divider">


  </div>
</footer>

<!-- Our own custom JS file -->
<script src="assets/js/script.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page-specific JavaScript -->
<?php if (!empty($extraJs)): ?>
    <?php foreach ($extraJs as $jsFile): ?>
        <script src="<?php echo htmlspecialchars($jsFile); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>