<?php
// Navbar
include_once("_navbar.php");

// Controller
if (isset($_GET['act'])) {
  $act = $_GET['act'];
  switch ($act) {
    case 'home':
      include_once("./home/index.php");
      break;

      // Detail 
    case 'detail':
      if (isset($_GET['idProduct'])) {
        $id = $_GET['idProduct'];
        $product = productSelectOne($id);
        $comments = commentGetAllForProduct($id);
        $imageProducts = productAttGetAllImageByIdPro($id);
        $colors = productAttGetAllColorByIdPro($id);
        $sizes = productAttGetAllSizeByIdPro($id);
      }
      include_once("./detail.php");
      break;

      // Shop 
    case 'shop':
      $categories = categoryGetAll();
      $products = productSelectAll();
      // Filter by category
      if (isset($_GET['idCategory'])) {
        $id = $_GET['idCategory'];
        $products = productFilterByIdCate($id);
      }
      // Search by name
      if (isset($_POST['searchByName'])) {
        $searchByName = $_POST['searchProduct'];
        $products = productSearchByName($searchByName);
      }
      // Sort price
      if (isset($_GET['sortPrice'])) {
        $sort = $_GET['sortPrice'];
        $products = productSortByPrice($sort);
      }
      include_once("./shop.php");
      break;

      // Contact
    case 'contact':
      include_once("./contact.php");
      break;

      // Cart
    case 'cart':
      include("./cart.php");
      break;
      // Checkout
    case 'checkout':
    case 'buy':
      include_once("./checkout.php");
      break;

      // Order detail
    case 'orderDetail':
      include_once("./profile/profile.php");
      break;

      // Add to cart
      // case 'buy':
      //   if (isset($_POST['buyNow'])) {
      //     $id = $_POST['idProduct'];
      //     echo $id;
      //   }
      //   break;

    default:
      include_once("./home/index.php");
  }
} else {
  include_once("./home/index.php");
}

// Footer
include_once("_footer.php");
