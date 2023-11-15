<?php
require_once '../dao/pdo.php';


function orderDetailGetAllById($id)
{
  $sql = "SELECT 
            `order_detail`.id,
            `order_detail`.id_order,
            `order_detail`.quantity,
            `product`.`name`,
            `product_size`.`size`,
            `product_color`.color,
            `product_attributes`.price,
            `order`.order_status
          FROM
            `order_detail`
                LEFT JOIN `product_attributes` 
                ON `product_attributes`.id = `order_detail`.id_pro_att
                LEFT JOIN `product` 
                ON `product_attributes`.id_pro = `product`.id
                LEFT JOIN `product_size` 
                ON `product_attributes`.id_size = `product_size`.id
                LEFT JOIN `product_color` 
                ON `product_attributes`.id_color = `product_color`.id
                LEFT JOIN `order` 
                ON `order`.id = `order_detail`.id_order
          WHERE
            `order_detail`.`id_order` = $id
          ORDER BY `order_detail`.id DESC";
  return pdo_query($sql);
}
