<div class="container-fluid shadow-sm sticky-top bg-light mb-2">
  <div class="row align-items-center py-3 px-xl-5">
    <!-- Logo -->
    <div class="col-lg-4 d-none d-lg-block">
      <a href="?act=home" class="text-decoration-none">
        <h1 class="m-0 display-5 font-weight-semi-bold">
          <span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
        </h1>
      </a>
    </div>

    <!-- Nav -->
    <div class="col-lg-4 col-6 d-flex justify-content-center">
      <nav class="navbar navbar-expand-lg navbar-light py-3 0">
        <div class="navbar-nav text-center">
          <a href="?act=shop" class="nav-item nav-link">Shop</a>
          <a href="?act=contact" class="nav-item nav-link">Contact</a>
        </div>
      </nav>
    </div>

    <!-- Cart -->
    <div class="col-lg-4 col-6 text-right">
      <!-- Total product -->
      <a href="?act=cart" class="btn border">
        <i class="fas fa-shopping-cart text-primary"></i>
        <span class="badge" id="totalProduct"></span>
      </a>
      <!-- Login -->
      <a href="../login/signIn.html" class="btn border">
        <i class="far fa-user text-primary"></i>
      </a>
      <!-- Check order -->
      <a href="?act=orderDetail" class="btn border">
        <i class="fas fa-calendar-week text-primary"></i>
      </a>

    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    showTotalProductCart();
  })

  function showTotalProductCart() {
    let total = localStorage.getItem("cartProductList");
    let totalCart = 0;
    if (total) {
      // Parse the cartList from JSON to an array
      total = JSON.parse(total);
      // Return the length of the cartList array
      totalCart = total.length;
    }
    $("#totalProduct").text(totalCart);
  }
</script>