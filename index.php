<?php

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- =========================================================
     1. HERO SECTION
     Big banner with background image, heading, and 2 buttons
========================================================= -->
<section class="dn-hero">
  <div class="dn-hero-overlay"></div>
  <div class="container">
    <div class="dn-hero-content">
      <h1 class="dn-hero-title">
        Transform Your Home Into A Beautiful Space
      </h1>
      <p class="dn-hero-text">
        Discover premium furniture, lighting, and decor pieces that
        bring warmth, comfort, and style to every corner of your home.
      </p>
      <div class="dn-hero-buttons">
        <a href="products.php" class="btn dn-btn-primary">Shop Now</a>
        <a href="#categories" class="btn dn-btn-outline">Explore Collection</a>
      </div>
    </div>
  </div>
</section>


<!-- =========================================================
     2. CATEGORIES SECTION
     4 cards: Sofa, Furniture, Lighting, Wall Art
========================================================= -->
<section id="categories" class="dn-section">
  <div class="container">

    <div class="dn-section-heading">
      <h2>Shop By Category</h2>
      <p>Find exactly what your home needs</p>
    </div>

    <div class="row g-4">

      <!-- Category Card: Sofa -->
      <div class="col-6 col-md-3">
        <a href="products.php?category=sofa" class="dn-category-card">
          <i class="bi bi-house-heart-fill dn-category-icon"></i>
          <h5>Sofa</h5>
        </a>
      </div>

      <!-- Category Card: Furniture -->
      <div class="col-6 col-md-3">
        <a href="products.php?category=furniture" class="dn-category-card">
          <i class="bi bi-lamp-fill dn-category-icon"></i>
          <h5>Furniture</h5>
        </a>
      </div>

      <!-- Category Card: Lighting -->
      <div class="col-6 col-md-3">
        <a href="products.php?category=lighting" class="dn-category-card">
          <i class="bi bi-lightbulb-fill dn-category-icon"></i>
          <h5>Lighting</h5>
        </a>
      </div>

      <!-- Category Card: Wall Art -->
      <div class="col-6 col-md-3">
        <a href="products.php?category=wallart" class="dn-category-card">
          <i class="bi bi-image-fill dn-category-icon"></i>
          <h5>Wall Art</h5>
        </a>
      </div>

    </div>
  </div>
</section>


<!-- =========================================================
     3. FEATURED PRODUCTS SECTION
     Static product cards (no database yet)
========================================================= -->
<section class="dn-section dn-section-grey">
  <div class="container">

    <div class="dn-section-heading">
      <h2>Featured Products</h2>
      <p>Our most loved pieces, chosen by you</p>
    </div>

    <div class="row g-4">

      <!-- Product 1: Luxury Sofa -->
      <div class="col-sm-6 col-lg-3">
        <div class="dn-product-card">
          <img src="assets/images/sofa.jpg" alt="Luxury Sofa" class="dn-product-img">
          <div class="dn-product-body">
            <h5 class="dn-product-name">Luxury Sofa</h5>
            <p class="dn-product-price">Rs. 25,000</p>
            <a href="product-details.php?name=luxury-sofa" class="btn dn-btn-view">View Details</a>
          </div>
        </div>
      </div>

      <!-- Product 2: Modern Chair -->
      <div class="col-sm-6 col-lg-3">
        <div class="dn-product-card">
          <img src="assets/images/chair.jpg" alt="Modern Chair" class="dn-product-img">
          <div class="dn-product-body">
            <h5 class="dn-product-name">Modern Chair</h5>
            <p class="dn-product-price">Rs. 8,000</p>
            <a href="product-details.php?name=modern-chair" class="btn dn-btn-view">View Details</a>
          </div>
        </div>
      </div>

      <!-- Product 3: Decor Lamp -->
      <div class="col-sm-6 col-lg-3">
        <div class="dn-product-card">
          <img src="assets/images/lamp.jpg" alt="Decor Lamp" class="dn-product-img">
          <div class="dn-product-body">
            <h5 class="dn-product-name">Decor Lamp</h5>
            <p class="dn-product-price">Rs. 3,500</p>
            <a href="product-details.php?name=decor-lamp" class="btn dn-btn-view">View Details</a>
          </div>
        </div>
      </div>

      <!-- Product 4: Wall Art -->
      <div class="col-sm-6 col-lg-3">
        <div class="dn-product-card">
          <img src="assets/images/wallart.jpg" alt="Wall Art" class="dn-product-img">
          <div class="dn-product-body">
            <h5 class="dn-product-name">Wall Art</h5>
            <p class="dn-product-price">Rs. 2,500</p>
            <a href="product-details.php?name=wall-art" class="btn dn-btn-view">View Details</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =========================================================
     4. INTERIOR DESIGN SERVICES SECTION
     3 service cards
========================================================= -->
<section class="dn-section">
  <div class="container">

    <div class="dn-section-heading">
      <h2>Our Interior Design Services</h2>
      <p>Let our experts help you design your dream home</p>
    </div>

    <div class="row g-4">

      <!-- Service 1 -->
      <div class="col-md-4">
        <div class="dn-service-card">
          <i class="bi bi-bounding-box-circles dn-service-icon"></i>
          <h5>Room Design</h5>
          <p>Custom room layouts designed to match your lifestyle and taste.</p>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-md-4">
        <div class="dn-service-card">
          <i class="bi bi-house-door-fill dn-service-icon"></i>
          <h5>Furniture Selection</h5>
          <p>We help you choose furniture that fits your space perfectly.</p>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-md-4">
        <div class="dn-service-card">
          <i class="bi bi-palette-fill dn-service-icon"></i>
          <h5>Decoration Planning</h5>
          <p>Complete decor planning from colors to final accessories.</p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =========================================================
     5. WHY CHOOSE DECORNEST SECTION
     4 simple feature boxes
========================================================= -->
<section class="dn-section dn-section-dark">
  <div class="container">

    <div class="dn-section-heading dn-heading-light">
      <h2>Why Choose DecorNest</h2>
      <p>We are committed to making your home beautiful</p>
    </div>

    <div class="row g-4 text-center">

      <div class="col-6 col-md-3">
        <i class="bi bi-gem dn-why-icon"></i>
        <h6>Premium Quality</h6>
      </div>

      <div class="col-6 col-md-3">
        <i class="bi bi-tag-fill dn-why-icon"></i>
        <h6>Affordable Price</h6>
      </div>

      <div class="col-6 col-md-3">
        <i class="bi bi-truck dn-why-icon"></i>
        <h6>Fast Delivery</h6>
      </div>

      <div class="col-6 col-md-3">
        <i class="bi bi-emoji-smile-fill dn-why-icon"></i>
        <h6>Customer Satisfaction</h6>
      </div>

    </div>
  </div>
</section>


<!-- =========================================================
     6. CUSTOMER TESTIMONIALS SECTION
     3 simple testimonial cards
========================================================= -->
<section class="dn-section">
  <div class="container">

    <div class="dn-section-heading">
      <h2>What Our Customers Say</h2>
      <p>Real feedback from real customers</p>
    </div>

    <div class="row g-4">

      <!-- Testimonial 1 -->
      <div class="col-md-4">
        <div class="dn-testimonial-card">
          <i class="bi bi-quote dn-quote-icon"></i>
          <p>"DecorNest helped me transform my living room completely.
             The sofa quality is amazing and delivery was very fast!"</p>
          <h6 class="dn-testimonial-name">- Sita Sharma</h6>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="col-md-4">
        <div class="dn-testimonial-card">
          <i class="bi bi-quote dn-quote-icon"></i>
          <p>"Great prices and beautiful designs. I bought a lamp and
             wall art, both look stunning in my bedroom."</p>
          <h6 class="dn-testimonial-name">- Rajesh Thapa</h6>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="col-md-4">
        <div class="dn-testimonial-card">
          <i class="bi bi-quote dn-quote-icon"></i>
          <p>"Excellent customer service and the products matched
             exactly what I saw on the website. Highly recommended!"</p>
          <h6 class="dn-testimonial-name">- Priya Gurung</h6>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- =========================================================
     7. NEWSLETTER SECTION
     Email input + Subscribe button
========================================================= -->
<section class="dn-newsletter">
  <div class="container">
    <div class="dn-newsletter-box">
      <h3>Subscribe To Our Newsletter</h3>
      <p>Get the latest offers and new arrivals directly in your inbox</p>

      <form class="dn-newsletter-form" onsubmit="return false;">
        <input type="email" class="form-control" placeholder="Enter your email address" required>
        <button type="submit" class="btn dn-btn-primary">Subscribe</button>
      </form>
    </div>
  </div>
</section>

<?php
include 'includes/footer.php';
?>