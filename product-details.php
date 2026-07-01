<?php
/* ====================================================
   FILE: product-details.php
   PURPOSE: Shows full details for ONE product.
   URL EXAMPLE: product-details.php?id=5

   HOW IT WORKS:
   1. Get the "id" from the URL.
   2. Loop through $products to find the matching one.
   3. Display its details, or show "not found" if no
      product matches that id.
==================================================== */

include 'includes/products-data.php';

$extraCss = ['assets/css/products.css'];
$extraJs  = ['assets/js/products.js', 'assets/js/product-details.js'];

include 'includes/header.php';
include 'includes/navbar.php';

/* ----------------------------------------------------
   STEP 1: Get the product id from the URL and make
   sure it's a number (security: prevents weird input).
---------------------------------------------------- */
$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

/* ----------------------------------------------------
   STEP 2: Search for the product with this id.
---------------------------------------------------- */
$currentProduct = null;

foreach ($products as $product) {
    if ($product['id'] === $productId) {
        $currentProduct = $product;
        break; // stop looping once found
    }
}

/* ----------------------------------------------------
   STEP 3: If no product was found, show a message
   and STOP the rest of the page from running.
---------------------------------------------------- */
if ($currentProduct === null) {
    echo '<div class="container py-5 text-center">';
    echo '<h3>Product not found</h3>';
    echo '<p>The product you are looking for does not exist.</p>';
    echo '<a href="products.php" class="btn dn-btn-primary">Back to Products</a>';
    echo '</div>';
    include 'includes/footer.php';
    exit; // stop the script here
}

/* ----------------------------------------------------
   STEP 4: Find 4 related products (same category,
   excluding the current product itself).
---------------------------------------------------- */
$relatedProducts = [];
foreach ($products as $product) {
    if ($product['category'] === $currentProduct['category'] && $product['id'] !== $currentProduct['id']) {
        $relatedProducts[] = $product;
    }
    if (count($relatedProducts) >= 4) {
        break;
    }
}
?>

<!-- =========================================================
     BREADCRUMB
========================================================= -->
<section class="dn-breadcrumb">
  <div class="container">
    <a href="index.php">Home</a> /
    <a href="products.php">Products</a> /
    <a href="products.php?category=<?php echo $currentProduct['category']; ?>">
      <?php echo htmlspecialchars($currentProduct['categoryName']); ?>
    </a> /
    <span><?php echo htmlspecialchars($currentProduct['name']); ?></span>
  </div>
</section>


<!-- =========================================================
     PRODUCT DETAILS
========================================================= -->
<section class="dn-section">
  <div class="container">
    <div class="row g-5">

      <!-- Large product image -->
      <div class="col-md-6">
        <div class="dn-details-img-wrap">
          <img src="<?php echo htmlspecialchars($currentProduct['image']); ?>"
               alt="<?php echo htmlspecialchars($currentProduct['name']); ?>"
               class="dn-details-img">
        </div>
      </div>

      <!-- Product info -->
      <div class="col-md-6">

        <span class="dn-product-category">
          <?php echo htmlspecialchars($currentProduct['categoryName']); ?>
        </span>

        <h1 class="dn-details-title">
          <?php echo htmlspecialchars($currentProduct['name']); ?>
        </h1>

        <!-- Star rating -->
        <div class="dn-product-rating dn-details-rating">
          <?php
          $rating = $currentProduct['rating'];
          for ($i = 1; $i <= 5; $i++) {
              if ($i <= floor($rating)) {
                  echo '<i class="bi bi-star-fill"></i>';
              } elseif ($i - $rating < 1) {
                  echo '<i class="bi bi-star-half"></i>';
              } else {
                  echo '<i class="bi bi-star"></i>';
              }
          }
          ?>
          <span class="dn-rating-number">(<?php echo $rating; ?> out of 5)</span>
        </div>

        <p class="dn-details-price">
          Rs. <?php echo number_format($currentProduct['price']); ?>
        </p>

        <p class="dn-details-description">
          <?php echo htmlspecialchars($currentProduct['description']); ?>
        </p>

        <!-- Quantity + Add to Cart -->
        <form action="add-to-cart.php" method="POST" class="dn-details-cart-form">
          <input type="hidden" name="product_id" value="<?php echo $currentProduct['id']; ?>">

          <label for="quantity" class="dn-qty-label">Quantity:</label>
          <div class="dn-qty-box">
            <button type="button" class="dn-qty-btn" id="qtyMinus">-</button>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10" readonly>
            <button type="button" class="dn-qty-btn" id="qtyPlus">+</button>
          </div>

          <button type="submit" class="btn dn-btn-primary dn-add-cart-big">
            <i class="bi bi-cart-plus"></i> Add to Cart
          </button>
        </form>

        <!-- Small trust badges -->
        <div class="dn-details-badges">
          <span><i class="bi bi-truck"></i> Fast Delivery</span>
          <span><i class="bi bi-shield-check"></i> Quality Assured</span>
          <span><i class="bi bi-arrow-repeat"></i> Easy Returns</span>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- =========================================================
     RELATED PRODUCTS
========================================================= -->
<?php if (count($relatedProducts) > 0): ?>
<section class="dn-section dn-section-grey">
  <div class="container">

    <div class="dn-section-heading">
      <h2>Related Products</h2>
      <p>You might also like these</p>
    </div>

    <div class="row g-4">
      <?php foreach ($relatedProducts as $product): ?>
        <div class="col-sm-6 col-lg-3">
          <div class="dn-product-card">

            <a href="product-details.php?id=<?php echo $product['id']; ?>" class="dn-product-img-link">
              <img src="<?php echo htmlspecialchars($product['image']); ?>"
                   alt="<?php echo htmlspecialchars($product['name']); ?>"
                   class="dn-product-img">
            </a>

            <div class="dn-product-body">
              <span class="dn-product-category">
                <?php echo htmlspecialchars($product['categoryName']); ?>
              </span>
              <h5 class="dn-product-name">
                <?php echo htmlspecialchars($product['name']); ?>
              </h5>
              <p class="dn-product-price">
                Rs. <?php echo number_format($product['price']); ?>
              </p>
              <div class="dn-product-actions">
                <a href="product-details.php?id=<?php echo $product['id']; ?>" class="btn dn-btn-view">
                  View Details
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>