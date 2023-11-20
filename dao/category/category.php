<?php
require_once '../dao/pdo.php';

// Select
function categoryGetAll()
{
  $sql = "SELECT * FROM `category` ORDER BY id DESC";
  return pdo_query($sql);
}

function categoryGetOne($id)
{
  $sql = "SELECT * FROM `category` WHERE `id`=$id";
  return pdo_query_one($sql);
}

function categoryInsert($name, $image)
{
  $sql = "INSERT INTO `category`(`name`,`image`)
          VALUES('$name','$image')";
  pdo_execute($sql);
}

function categoryUpdate($name, $image, $id)
{
  $sql = "UPDATE `category` 
          SET `name`='$name', `image`='$image'
          WHERE `id`=$id";
  pdo_execute($sql);
}


function categoryDelete($id, $status)
{
  $sql = "UPDATE `category` 
          SET `status`='$status'
          WHERE `id`=$id";
  pdo_execute($sql);
}