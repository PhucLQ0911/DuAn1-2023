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
      // Get
      $categories = categoryGetAll();
      $products = productSelectAll();

      // Pagination
      $itemPerPage = !empty($_GET['perPage']) ? $_GET['perPage'] : 1;
      $currentPage = !empty($_GET['Page']) ? $_GET['Page'] : 1;
      $offset = ($currentPage - 1) * $itemPerPage;

      // Filter by category
      if (isset($_GET['idCategory'])) {
        $id = $_GET['idCategory'];
        // Pagination
        $sql = "SELECT `id` FROM `product` WHERE `id_cate`=$id";
        $totalRecords = pdo_query_row($sql);
        $totalPage = ceil($totalRecords / $itemPerPage);
        $products = productFilterByIdCate($id, $itemPerPage, $offset);
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
      if (isset($_POST['placeOrder'])) {
        echo "<script>localStorage.removeItem('cartProductList')</script>";
      }
      include_once("./checkout.php");
      break;

      // Add to cart
    case 'buy':
      if (isset($_POST['buyNow'])) {
        $id = $_POST['idProduct'];
      }
      include_once("./buyNow.php");
      break;

    case 'profile':
      if (isset($_POST['profile'])) {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $image = $_POST['oldImage'];
        $newImage = $_FILES['image']['name'];
        if ($newImage != "") {
          $image = $newImage;
        }
        // save image
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        loginUpdateUser($fullname, $phone, $address, $image, $id);
        $_SESSION['user'] =  loginUserOne($id);
        header("location:?act=profile");
      }
      include "profile/profile.php";
      break;
      // signOut
    case 'signOut':
      session_unset();
      header("location: ../user/index.php");
      break;

    case 'orderDetail':
      include('./checkOrder.php');
      break;

    default:
      include_once("./home/index.php");
  }
} else {
  include_once("./home/index.php");
}

// Footer
include_once("_footer.php");
