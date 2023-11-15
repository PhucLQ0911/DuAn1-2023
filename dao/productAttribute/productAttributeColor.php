<?php
require_once '../dao/pdo.php';

function productAttGetAllColor()
{
  $sql = "SELECT `id`, `color`  FROM `product_color`";
  return pdo_query($sql);
}
