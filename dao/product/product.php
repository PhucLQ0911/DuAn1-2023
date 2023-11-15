<?php
require_once '../dao/pdo.php';

function productInsert($name, $image, $description, $price, $category)
{
    $sql = "INSERT INTO product (name, image, description, price, id_cate) VALUES ('$name','$image','$description','$price','$category')";
    pdo_execute($sql);
}

function productSelectAll()
{
    $sql = "SELECT * FROM product ORDER BY id DESC";
    return pdo_query($sql);
}

function productSelectOne($id)
{
    $sql = "SELECT * FROM product WHERE id =" . $id;
    $pro = pdo_query_one($sql);
    return $pro;
}

function productSelectLast()
{
    $sql = "SELECT `id` FROM `product` ORDER BY id DESC LIMIT 1;";
    return pdo_query($sql);
}

function productUpdate($id, $name, $price, $image, $description, $category)
{
    $sql = "UPDATE product SET id_cate ='" . $category . "', name ='" . $name . "', price ='" . $price . "', image ='" . $image . "', description ='" . $description . "' WHERE id=" . $id;
    pdo_execute($sql);
}

function productDelete($id, $status)
{
    $sql = "UPDATE product SET status = '$status' where id=?";
    pdo_execute($sql, $id);
}



function proView($id)
{
    $sql = "UPDATE product SET view += 1 WHERE id=?";
    pdo_execute($sql, $id);
}


function productGetAll()
{
    $sql = "SELECT `product`.id AS `pro_id`, `product`.`name` AS `pro_name`, `product`.image, `product`.`description`, `product`.price, `category`.`name` AS `cate_name`, `product`.`view`, `product`.added_on ,`product`.`status`
    FROM `product`
    LEFT JOIN `category` on `category`.id = `product`.id_cate
    ORDER BY `product`.id DESC";
    return  pdo_query($sql);
}
