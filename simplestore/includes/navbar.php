<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm py-3">
  <div class="container">
    <!-- Left Side Links -->
    <div class="d-flex align-items-center">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="/simplestore/about.php">
            <i class="fas fa-info-circle me-2"></i> About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="/simplestore/products/products.php">
            <i class="fas fa-th-large me-2"></i> Products
          </a>
        </li>
      </ul>
    </div>

    <!-- Center Logo -->
    <a class="navbar-brand mx-auto d-flex align-items-center" href="/simplestore">
      <img src="/simplestore/images/simplestore-logo.png" alt="" width="40" height="40" class="d-inline-block align-text-top me-2">
      <span class="fw-bold fs-3 text-success">Simplestore</span>
    </a>

    <!-- Right Side Links -->
    <div class="d-flex align-items-center">
      <ul class="navbar-nav ms-auto align-items-center">
       
        <li class="nav-item position-relative">
    <a class="nav-link d-flex align-items-center" href="/simplestore/cart/cart.php">
        <i class="fas fa-shopping-cart me-2"></i> Cart
        <!-- Cart count in navbar -->
<span id="cart-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle">0</span>

    </a>
</li>

        <!-- Corrected Orders Link -->
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="/simplestore/order/orderpage.php">
            <i class="fas fa-box me-2"></i> Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="/simplestore/contact.php">
            <i class="fas fa-envelope me-2"></i> Contact
          </a>
        </li>
        <?php if (isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/simplestore/account.php">
              <i class="fas fa-user-circle me-2"></i> My Account
            </a>
          </li>
          <li class="nav-item">
            <a class="btn btn-danger ms-3 d-flex align-items-center" href="/simplestore/Authentication/logout.php">
              <i class="fas fa-sign-out-alt me-2"></i> Log Out
            </a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/simplestore/Authentication/login.php">
              <i class="fas fa-sign-in-alt me-2"></i> Log In
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="/simplestore/Authentication/register.php">
              <i class="fas fa-user-plus me-2"></i> Register
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- External JS Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
 $(document).ready(function() {
  // Fetch the cart count when the page loads
  updateCartCount();

  // Function to update cart count
  function updateCartCount() {
    $.ajax({
      url: '/simplestore/cart/cart_count.php', // Ensure this path is correct
      method: 'GET',
      success: function(data) {
        $('#cart_count').text(data);  // Update the cart count in the navbar
      },
      error: function() {
        console.error('Error fetching cart count.');
        $('#cart_count').text('0');  // If the AJAX fails, display 0
      }
    });
  }
});

</script>



