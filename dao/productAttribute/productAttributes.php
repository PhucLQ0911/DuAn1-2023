<?php
require_once '../dao/pdo.php';

function productAttInsert($idProduct, $price, $idColor, $idSize, $quantity, $image)
{
  $sql = "INSERT INTO `product_attributes`(`id_pro`, `price`, `id_color`, `id_size`, `quantity`, `image`) 
          VALUES($idProduct,$price, $idColor,$idSize, $quantity, '$image')";
  pdo_execute($sql);
}

function productAttGetByIdProduct($id)
{
  $sql = "SELECT `product_attributes`.id,`product_attributes`.id_pro, `product_size`.size,`product_color`.color, image, sold, quantity, price, `product_attributes`.`status` FROM `product_attributes` 
  LEFT JOIN `product_size` ON `product_size`.id = `product_attributes`.id_size
  LEFT JOIN `product_color` ON `product_color`.id = `product_attributes`.id_color
  WHERE `product_attributes`.id_pro=$id 
  ORDER BY id DESC";
  return pdo_query($sql);
}


function productAttGetOne($id)
{
  $sql = "SELECT * FROM `product_attributes` 
  WHERE id=$id";
  return pdo_query_one($sql);
}


function productAttUpdate($id, $price, $quantity, $image)
{
  $sql = "UPDATE `product_attributes` 
          SET `price`=$price, `quantity`=$quantity, `image`='$image'
          WHERE `id`=$id";
  pdo_execute($sql);
}


function productAttDelete($id, $num)
{
  $sql = "UPDATE `product_attributes` 
          SET `status`='$num'
          WHERE `id`=$id";
  pdo_execute($sql);
}

function productAttGetAllImageByIdPro($id)
{
  $sql = "SELECT `image` FROM `product_attributes` WHERE `id_pro`=$id";
  return pdo_query($sql);
}

function productAttGetPrice($idColor, $idSize, $idPro)
{
  $sql = "SELECT `price` FROM `product_attributes` 
        WHERE id_color =$idColor AND `id_size`=$idSize AND `id_pro` = $idPro";
  return pdo_query_one($sql);
}
