<?php
session_start();
include_once "../dao/category/category.php";
include_once "../dao/product/product.php";
include_once "../dao/productAttribute/productAttributes.php";
include_once "../dao/productAttribute/productAttributeColor.php";
include_once "../dao/productAttribute/productAttributeSize.php";
include_once "../dao/user/user.php";
include_once "../dao/comment/comment.php";
include_once "../dao/order/order.php";
include_once "../dao/orderDetail/orderDetail.php";
include_once "../dao/login/login.php";
ob_start();
if (!isset($_SESSION['user'])) {
  header("location: ../login/signIn.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template" />

  <title>Admin</title>

  <link rel="preconnect" href="//fonts.gstatic.com/" crossorigin="" />

  <!-- PICK ONE OF THE STYLES BELOW -->
  <link href="./css/classic.css" rel="stylesheet" />
</head>

<body>
  <!-- Default setting -->
  <script src="./js/app.js"></script>
  <div class="wrapper">
    <!-- Left menu -->
    <?php include("left-menu.php") ?>
    <div class="main">
      <?php
      // Header
      include("header.php");

      // Main
      if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
          case 'home':
          case 'dashboard':
            include("dashboard/dashboard.php");
            break;

            // Category
            // List category
          case 'listCategory':
            $categories = categoryGetAll();
            include("category/list-category.php");
            // Update success
            if (isset($_GET['isSuccessUpdate'])) {
              $isSuccessUpdate = $_GET['isSuccessUpdate'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Update')</script>";
              }
            }
            // Delete success
            if (isset($_GET['isSuccessDelete'])) {
              $isSuccessUpdate = $_GET['isSuccessDelete'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Delete')</script>";
              }
            }
            break;

            // Add category
          case 'addCategory':
            $success = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $name = $_POST['validation-category-name'];
              $image = $_FILES['validation-category-file'];
              // Save image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image['name']);
              move_uploaded_file($image["tmp_name"], $target_file);

              // check Name Category
              $categoryCheck = categoryCheck($name);
              if (is_array($categoryCheck)) {
                extract($categoryCheck);
                if ($status == 0) {
                  echo "name đã tồn tại";
                } else {
                  // update 
                  categoryReUpdate($image['name'], $id);
                  $success = 1;
                }
              } else {
                // Insert
                categoryInsert($name, $image['name']);
                $success = 1;
              }
            }
            include("category/add-category.php");
            if ($success == 1) {
              echo "<script>showToast()</script>";
              $success = 0;
            }
            break;

            // Update category
          case 'updateCategory':
            if (isset($_GET['idCategory']) & $_GET['idCategory'] > 0) {
              $idCate = $_GET['idCategory'];
              $category = categoryGetOne($idCate);
            }
            if (isset($_POST['updateCategory'])) {
              $name = $_POST['validation-category-name'];
              $image = $_POST['oldImage'];
              $newImage = $_FILES['validation-category-file']['name'];
              $idCate = $_POST['idCategory'];

              if ($newImage != "") {
                $image = $newImage;
              }
              // Save image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image);
              move_uploaded_file($_FILES["validation-category-file"]["tmp_name"], $target_file);

              categoryUpdate($name, $image, $idCate);
              header("location: ?act=listCategory&isSuccessUpdate=1");
            }
            include("category/update-category.php");
            break;

            // Delete cate
          case 'deleteCategory':
            if (isset($_GET['idCategory'])) {
              $idCate = $_GET['idCategory'];
              $cateStatus = categoryGetOne($idCate)['status'];
              if ($cateStatus == 0) {
                $cateStatus = 1;
              } else {
                $cateStatus = 0;
              }
              categoryDelete($idCate, $cateStatus);
              header("location: ?act=listCategory&isSuccessDelete=1");
            }
            break;

            // Product
          case 'listProduct':
            $products = productGetAll();
            include("product/list-product.php");
            // Update success
            if (isset($_GET['isSuccessUpdate'])) {
              $isSuccessUpdate = $_GET['isSuccessUpdate'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Update')</script>";
              }
            }
            // Delete success
            if (isset($_GET['isSuccessDelete'])) {
              $isSuccessUpdate = $_GET['isSuccessDelete'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Delete')</script>";
              }
            }
            break;

          case 'addProduct':
            $isSuccess = 0;
            if (isset($_POST['addPro'])) {
              // Product
              $name = $_POST['validation-product-name'];
              $image = $_FILES["validation-product-file"];
              $price = $_POST['validation-product-price'];
              $description = $_POST['validation-product-description'];
              $category = $_POST['validation-product-select'];

              // Save image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image['name']);
              move_uploaded_file($image["tmp_name"], $target_file);

              // check name Product
              $productCheck = productCheck($name);
              if (is_array($productCheck)) {
                extract($productCheck);
                if ($status == 0) {
                  echo "name đã tồn tại </br>";
                } else {
                  // update
                  productReUpdate($category, $price, $image['name'], $description, $id);
                }
              } else {
                // Insert
                productInsert($name, $image['name'], $description, $price, $category);
              }

              // Lay ra id cua san pham vua them vao
              $idCurrent = productSelectLast();
              $idPro = $idCurrent[0]['id'];

              // Product att
              $priceAtt = $_POST['validation-product-att-price'];
              $quantityAtt = $_POST['validation-product-att-qty'];
              $colorAtt = $_POST['validation-product-att-color-id'];
              $sizeAtt = $_POST['validation-product-att-size-id'];
              $imgAtt = $_FILES['validation-product-att-image'];
              $color = implode(', ', $colorAtt);
              $size = implode(', ', $sizeAtt);

              for ($i = 0; $i < sizeof($priceAtt); $i++) {
                // Save image
                $target_dir = "../uploads/";
                $target_file = $target_dir . basename($imgAtt['name'][$i]);
                move_uploaded_file($imgAtt["tmp_name"][$i], $target_file);

                // check size color product
                $productAttCheck = productAttCheck($color, $size, $idPro);
                if (is_array($productAttCheck)) {
                  echo "size và color đã tồn tại";
                } else {
                  // Insert
                  productAttInsert($idPro, $priceAtt[$i], $colorAtt[$i], $sizeAtt[$i], $quantityAtt[$i], $imgAtt['name'][$i]);
                }
              }
              $isSuccess = 1;
            }
            $categories = categoryGetAll();
            $productSizes = productAttGetAllSize();
            $productColors = productAttGetAllColor();
            include("product/add-productv1.php");
            if ($isSuccess == 1) {
              echo "<script>showToast()</script>";
              $isSuccess = 0;
            }
            break;

          case 'updateProduct':
            if (isset($_GET['idProduct'])) {
              $id = $_GET['idProduct'];
              $product = productSelectOne($id);
            }
            if (isset($_POST['updateProduct'])) {
              $id = $_POST['idProduct'];
              $name = $_POST['validation-product-name'];
              $image = $_POST['oldImage'];
              $newImage = $_FILES["validation-product-file"]['name'];
              $price = $_POST['validation-product-price'];
              $description = $_POST['validation-product-description'];
              $category = $_POST['validation-product-select'];

              if ($newImage != "") {
                $image = $newImage;
              }
              // Save image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image);
              move_uploaded_file($_FILES["validation-product-file"]["tmp_name"], $target_file);

              // Update
              productUpdate($id, $name, $price, $image, $description, $category);
              header("location: ?act=listProduct&isSuccessUpdate=1");
            }
            $categories = categoryGetAll();
            include("product/update-product.php");
            break;

            // Delete product
          case 'deleteProduct':
            if (isset($_GET['idProduct'])) {
              $id = $_GET['idProduct'];
              $status = productSelectOne($id)['status'];
              if ($status == 0) {
                $status = 1;
              } else {
                $status = 0;
              }
              productDelete($id, $status);
              header("location: ?act=listProduct&isSuccessDelete=1");
            }
            break;

            // Product Attributes
          case 'attributeProduct':
            $idProduct = $_GET['idProduct'];
            $productAttributes = productAttGetByIdProduct($idProduct);
            include("productAttribute/list-attribute.php");
            // Update success
            if (isset($_GET['isSuccessUpdate'])) {
              $isSuccessUpdate = $_GET['isSuccessUpdate'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Update')</script>";
              }
            }
            // Delete success
            if (isset($_GET['isSuccessDelete'])) {
              $isSuccessUpdate = $_GET['isSuccessDelete'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Delete')</script>";
              }
            }
            break;

            // Add product att
          case 'addProductAttribute':
            $isSuccess = 0;
            if (isset($_POST['addProAtt'])) {
              // Product att
              $idPro = $_GET['idProduct'];
              $priceAtt = $_POST['validation-product-att-price'];
              $quantityAtt = $_POST['validation-product-att-qty'];
              $colorAtt = $_POST['validation-product-att-color-id'];
              $sizeAtt = $_POST['validation-product-att-size-id'];
              $imgAtt = $_FILES['validation-product-att-image']['name'];
              $color = implode(', ', $colorAtt);
              $size = implode(', ', $sizeAtt);
              $price = implode($priceAtt);
              $quantity = implode($quantityAtt);
              $image = implode($imgAtt);

              // save Image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image);
              move_uploaded_file(implode($_FILES['validation-product-att-image']['tmp_name']), $target_file);
              // check size color
              $productAttCheck = productAttCheck($color, $size, $idPro);
              if (is_array($productAttCheck)) {
                extract($productAttCheck);
                if ($status == 0) {
                  echo "size và color đã tồn tại";
                } else {
                  // update
                  productAttReUpdate($price, $quantity, $image, $id);
                }
              } else {
                for ($i = 0; $i < sizeof($priceAtt); $i++) {
                  productAttInsert($idPro, $priceAtt[$i], $colorAtt[$i], $sizeAtt[$i], $quantityAtt[$i], $imgAtt[$i]);
                }
                $isSuccess = 1;
              }
            }
            $categories = categoryGetAll();
            $productSizes = productAttGetAllSize();
            $productColors = productAttGetAllColor();
            include("productAttribute/add-attribute.php");
            if ($isSuccess == 1) {
              echo "<script>showToast()</script>";
              $isSuccess = 0;
            }
            break;

            // Update product att
          case 'updateProductAttribute':
            if (isset($_GET['idProductAttribute'])) {
              $proAtt = productAttGetOne($_GET['idProductAttribute']);
            }
            if (isset($_POST['updateProAtt'])) {
              $idAtt = $_POST['idProductAttribute'];
              $idPro = $_POST['idProduct'];
              $price = $_POST['validation-product-att-price'];
              $quantity = $_POST['validation-product-att-qty'];
              $image = $_POST['oldImage'];
              $newImage = $_FILES['validation-product-att-image']['name'];
              if ($newImage != "") {
                $image = $newImage;
              }
              // save Image
              $target_dir = "../uploads/";
              $target_file = $target_dir . basename($image);
              move_uploaded_file($_FILES['validation-product-att-image']['tmp_name'], $target_file);

              productAttUpdate($idAtt, $price, $quantity, $image);
              header("location: ?act=attributeProduct&idProduct=$idPro&isSuccessUpdate=1");
            }
            $productSizes = productAttGetAllSize();
            $productColors = productAttGetAllColor();
            include("productAttribute/update-attribute.php");
            break;

            // Delete product att
          case 'deleteProductAttribute':
            if (isset($_GET['idProductAttribute']) && $_GET['idProductAttribute'] > 0) {
              $idPro = $_GET['idProduct'];
              $idProAtt = $_GET['idProductAttribute'];
              $proAtt =  productAttGetOne($idProAtt);
              $status = 0;
              if ($proAtt['status'] == 0) {
                $status = 1;
              }
              productAttDelete($idProAtt, $status);
              header("location: ?act=attributeProduct&idProduct=$idPro&isSuccessDelete=1");
            }
            break;

            // User
          case 'listUser':
            $users = userGetAll();
            include("user/list-user.php");
            // Delete success
            if (isset($_GET['isSuccessDelete'])) {
              $isSuccessUpdate = $_GET['isSuccessDelete'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Delete')</script>";
              }
            }
            break;
          case 'addUser':
            include("../admin/pages-404.php");
            break;
          case 'updateUser':
            include("../admin/pages-404.php");
            break;
          case 'deleteUser':
            $isSuccess = 0;
            if (isset($_GET['idUser'])) {
              $id = $_GET['idUser'];
              $status = userGetOne($id)['status'];
              if ($status == 0) {
                $status = 1;
              } else {
                $status = 0;
              }
              userDelete($id, $status);
              $isSuccess = 1;
              header("location: ?act=listUser&isSuccessDelete=$isSuccess");
            }
            break;

            // Comment
          case 'comment':
            $comments = commentGetAll();
            include("comment/list-comment.php");
            break;
          case 'detailComment':
            if (isset($_GET['idPro'])) {
              $id = $_GET['idPro'];
              $comments = commentGetDetail($id);
            }
            include("comment/detail-comment.php");
            if (isset($_GET['isSuccessDelete'])) {
              $isSuccessUpdate = $_GET['isSuccessDelete'];
              if ($isSuccessUpdate == 1) {
                echo "<script>showToast('Delete')</script>";
              }
            }
            break;
          case 'deleteComment':
            $isSuccess = 0;
            if (isset($_GET['idComment'])) {
              $idPro = $_GET['idPro'];
              $id = $_GET['idComment'];
              commentDelete($id);
              $isSuccess = 1;
              header("location: ?act=detailComment&idPro=$idPro&isSuccessDelete=$isSuccess");
            }
            break;
            // Order
          case 'order':
            $orders =  orderGetAll();
            include("order/list-order.php");
            // Confirm success
            if (isset($_GET['isSuccessConfirm'])) {
              $isSuccessConfirm = $_GET['isSuccessConfirm'];
              if ($isSuccessConfirm == 1) {
                echo "<script>showToast('Confirm')</script>";
              }
            }

            // Refuse success
            if (isset($_GET['isSuccessRefuse'])) {
              $isSuccessRefuse = $_GET['isSuccessRefuse'];
              if ($isSuccessRefuse == 1) {
                echo "<script>showToast('Refuse')</script>";
              }
            }
            break;
          case 'detailOrder':
            if (isset($_GET['idOrder'])) {
              $id = $_GET['idOrder'];
              $orderDetails = orderDetailGetAllById($id);
            }
            include("order/detail-order.php");
            break;

          case 'confirmOrder':
            if (isset($_GET['idOrder'])) {
              $id = $_GET['idOrder'];
              orderSetStatusOrder(2,$id);
              header("location: ?act=order&isSuccessConfirm=1");
            }
            break;
           
           
          case 'refuseOrder':
            if (isset($_GET['idOrder'])) {
              $id = $_GET['idOrder'];
              orderSetStatusOrder(1,$id);
              header("location: ?act=order&isSuccessRefuse=1");
            }
            break;

            // Profile
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

            // Help
          case 'help':
            include("../admin/pages-404.php");
            break;

            // Default
          default:
            include("dashboard/dashboard.php");
            break;
        }
      } else {
        include("dashboard/dashboard.php");
      }

      // Footer
      include("footer.php");
      ?>
    </div>
  </div>

</body>

</html>

<?php
ob_end_flush();
?>