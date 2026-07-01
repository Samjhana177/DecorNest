<?php
/* ====================================================
   FILE: cart.php
   PURPOSE: Shows everything currently in the user's
   session cart - image, name, price, quantity, a
   remove button, and the grand total.
==================================================== */

include 'includes/products-data.php'; // gives us $products array

$extraCss = ['assets/css/products.css'];

include 'includes/header.php';
include 'includes/navbar.php';

/* ----------------------------------------------------
   STEP 1: Build a list of "cart items" by matching
   each product id in $_SESSION['cart'] with its full
   details from the $products array.
---------------------------------------------------- */
$cartItems  = [];
$grandTotal = 0;

if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {

    foreach ($_SESSION['cart'] as $productId => $quantity) {

        // Find the matching product from $products
        foreach ($products as $product) {
            if ($product['id'] === (int) $productId) {

                $subtotal = $product['price'] * $quantity;

                $cartItems[] = [
                    'id'       => $product['id'],
                    'name'     => $product['name'],
                    'image'    => $product['image'],
                    'price'    => $product['price'],
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];

                $grandTotal += $subtotal;
                break;
            }
        }
    }
}
?>

<!-- =========================================================
     PAGE BANNER
========================================================= -->
<section class="dn-page-banner">
  <div class="container">
    <h1>My Cart</h1>
    <p>Review your selected items before checkout</p>
  </div>
</section>


<!-- =========================================================
     CART CONTENT
========================================================= -->
<section class="dn-section">
  <div class="container">

    <?php if (count($cartItems) === 0): ?>

      <!-- Empty cart message -->
      <div class="dn-empty-cart">
        <i class="bi bi-cart-x"></i>
        <h4>Your cart is empty</h4>
        <p>Looks like you haven't added anything yet.</p>
        <a href="products.php" class="btn dn-btn-primary">Browse Products</a>
      </div>

    <?php else: ?>

      <div class="row g-4">

        <!-- LEFT: Cart items table -->
        <div class="col-lg-8">
          <div class="dn-cart-table-wrap">
            <table class="table dn-cart-table align-middle">
              <thead>
                <tr>
                  <th colspan="2">Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($cartItems as $item): ?>
                  <tr>
                    <td class="dn-cart-img-cell">
                      <img src="<?php echo htmlspecialchars($item['image']); ?>"
                           alt="<?php echo htmlspecialchars($item['name']); ?>">
                    </td>
                    <td class="dn-cart-name-cell">
                      <?php echo htmlspecialchars($item['name']); ?>
                    </td>
                    <td>Rs. <?php echo number_format($item['price']); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rs. <?php echo number_format($item['subtotal']); ?></td>
                    <td>
                      <a href="remove-cart.php?id=<?php echo $item['id']; ?>"
                         class="dn-remove-btn"
                         title="Remove item">
                        <i class="bi bi-trash3-fill"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <a href="products.php" class="dn-continue-shopping">
            <i class="bi bi-arrow-left"></i> Continue Shopping
          </a>
        </div>

        <!-- RIGHT: Order summary -->
        <div class="col-lg-4">
          <div class="dn-cart-summary">
            <h5>Order Summary</h5>

            <div class="dn-summary-row">
              <span>Subtotal</span>
              <span>Rs. <?php echo number_format($grandTotal); ?></span>
            </div>

            <div class="dn-summary-row">
              <span>Delivery</span>
              <span>Free</span>
            </div>

            <hr>

            <div class="dn-summary-row dn-summary-total">
              <span>Total</span>
              <span>Rs. <?php echo number_format($grandTotal); ?></span>
            </div>

            <button type="button" class="btn dn-btn-primary dn-checkout-btn">
              Proceed to Checkout
            </button>
            <p class="dn-checkout-note">
              * Checkout system will be added in the next phase.
            </p>
          </div>
        </div>

      </div>

    <?php endif; ?>

  </div>
</section>

<?php include 'includes/footer.php'; ?>