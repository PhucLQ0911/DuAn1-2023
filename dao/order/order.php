<?php
require_once '../dao/pdo.php';

function orderGetAll()
{
  $sql = "SELECT 
            `order`.id,
            `order`.fullname,
            `order`.phone,
            `order`.address,
            `order`.email,
            `order`.total_payment,
            `order`.added_on,
            `order`.order_status,
            `payment`.method
          FROM
            `order`
                LEFT JOIN
            `payment` ON `payment`.id = `order`.payment_id";
  return pdo_query($sql);
}

function orderSetStatusOrder($status,$id)
{
  $sql = "UPDATE `order` SET `order_status`= '$status' WHERE `id`=$id";
  pdo_execute($sql);
}

function orderInsert($fullname,$phone,$address,$email,$total,$payment){
  $sql = "INSERT INTO `order` (fullname,phone,address,email,total_payment,payment_id) VALUES ('$fullname','$phone','$address','$email','$total','$payment')";
  pdo_execute($sql);
}
function orderSelectLastId()
{
    $sql = "SELECT `id` FROM `order` ORDER BY id DESC LIMIT 1";
    return pdo_query($sql);
}