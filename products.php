<?php

$productsDataFile = __DIR__ . '/includes/products-data.php';

if (!file_exists($productsDataFile)) {
    die(
        'ERROR: Could not find includes/products-data.php. ' .
        'Make sure the file exists at: ' . $productsDataFile
    );
}

// Load the product data ($products array) and category list
include $productsDataFile;

if (!isset($products) || !is_array($products)) {
    die('ERROR: $products array was not created. Check includes/products-data.php for errors.');
}

if (!isset($categories) || !is_array($categories)) {
    die('ERROR: $categories array was not created. Check includes/products-data.php for errors.');
}

// Tell header.php to also load our products.css file
$extraCss = ['assets/css/products.css'];
// Tell footer.php to also load our products.js file
$extraJs  = ['assets/js/products.js'];

include 'includes/header.php';
include 'includes/navbar.php';

$selectedCategory = isset($_GET['category']) ? $_GET['category'] : 'all';

$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

$filteredProducts = [];

foreach ($products as $product) {

    // Check category match (skip this check if "all" is selected)
    $matchesCategory = ($selectedCategory === 'all' || $product['category'] === $selectedCategory);

    // Check search match (skip this check if search box is empty)
    $matchesSearch = true;
    if ($searchKeyword !== '') {
        // stripos() finds text inside a string, ignoring uppercase/lowercase
        $matchesSearch = (stripos($product['name'], $searchKeyword) !== false);
    }

    // Only keep the product if BOTH checks pass
    if ($matchesCategory && $matchesSearch) {
        $filteredProducts[] = $product;
    }
}

// Get a nice display name for the currently selected category
$selectedCategoryName = 'All Products';
foreach ($categories as $cat) {
    if ($cat['slug'] === $selectedCategory) {
        $selectedCategoryName = $cat['name'];
    }
}
?>

<section class="dn-page-banner">
  <div class="container">
    <h1>Our Products</h1>
    <p>Browse our complete collection of premium home decor</p>
  </div>
</section>

<section class="dn-search-section">
  <div class="container">
    <form action="products.php" method="GET" class="dn-search-form">

      <!-- Keep the current category selected when searching -->
      <input type="hidden" name="category" value="<?php echo htmlspecialchars($selectedCategory); ?>">

      <input
        type="text"
        name="search"
        class="form-control"
        placeholder="Search products..."
        value="<?php echo htmlspecialchars($searchKeyword); ?>">

      <button type="submit" class="btn dn-btn-primary">
        <i class="bi bi-search"></i> Search
      </button>
    </form>
  </div>
</section>

<section class="dn-category-filter">
  <div class="container">
    <div class="dn-filter-buttons">

      <!-- "All" button -->
      <a href="products.php"
         class="dn-filter-btn <?php echo ($selectedCategory === 'all') ? 'active' : ''; ?>">
        All
      </a>

      <!-- One button per category, built with a loop -->
      <?php foreach ($categories as $cat): ?>
        <a href="products.php?category=<?php echo $cat['slug']; ?>"
           class="dn-filter-btn <?php echo ($selectedCategory === $cat['slug']) ? 'active' : ''; ?>">
          <i class="bi <?php echo $cat['icon']; ?>"></i>
          <?php echo $cat['name']; ?>
        </a>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<section class="dn-section">
  <div class="container">

    <div class="dn-products-header">
      <h4><?php echo htmlspecialchars($selectedCategoryName); ?></h4>
      <span class="dn-products-count">
        <?php echo count($filteredProducts); ?> products found
      </span>
    </div>

    <?php if (count($filteredProducts) === 0): ?>

      <!-- Shown when no products match the search/filter -->
      <div class="dn-no-products">
        <i class="bi bi-emoji-frown"></i>
        <p>No products found. Try a different search or category.</p>
      </div>

    <?php else: ?>

      <div class="row g-4">
        <?php foreach ($filteredProducts as $product): ?>

          
          <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="dn-product-card">

              <!-- Product image (clicking it goes to details page) -->
              <a href="product-details.php?id=<?php echo $product['id']; ?>" class="dn-product-img-link">
                <img src="<?php echo htmlspecialchars($product['image']); ?>"
                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                     class="dn-product-img">
              </a>

              <div class="dn-product-body">

                <!-- Category tag -->
                <span class="dn-product-category">
                  <?php echo htmlspecialchars($product['categoryName']); ?>
                </span>

                <!-- Product name -->
                <h5 class="dn-product-name">
                  <?php echo htmlspecialchars($product['name']); ?>
                </h5>

                <!-- Star rating -->
                <div class="dn-product-rating">
                  <?php
                  $rating = $product['rating'];
                  // Print 5 stars, filling them based on rating value
                  for ($i = 1; $i <= 5; $i++) {
                      if ($i <= floor($rating)) {
                          echo '<i class="bi bi-star-fill"></i>'; // full star
                      } elseif ($i - $rating < 1) {
                          echo '<i class="bi bi-star-half"></i>'; // half star
                      } else {
                          echo '<i class="bi bi-star"></i>'; // empty star
                      }
                  }
                  ?>
                  <span class="dn-rating-number">(<?php echo $rating; ?>)</span>
                </div>

                <!-- Price -->
                <p class="dn-product-price">
                  Rs. <?php echo number_format($product['price']); ?>
                </p>

                <!-- Action buttons -->
                <div class="dn-product-actions">
                  <a href="product-details.php?id=<?php echo $product['id']; ?>"
                     class="btn dn-btn-view">
                    View Details
                  </a>

                  <!-- Add to Cart form (sends product id to add-to-cart.php) -->
                  <form action="add-to-cart.php" method="POST" class="dn-add-cart-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" class="btn dn-btn-cart">
                      <i class="bi bi-cart-plus"></i>
                    </button>
                  </form>
                </div>

              </div>
            </div>
          </div>
          

        <?php endforeach; ?>
      </div>

    <?php endif; ?>

  </div>
</section>

<?php include 'includes/footer.php'; ?>