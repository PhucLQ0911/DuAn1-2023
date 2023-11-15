<?php
require_once '../dao/pdo.php';

function productAttGetAllSize()
{
  $sql = "SELECT `id`, `size` FROM `product_size`";
  return pdo_query($sql);
}
