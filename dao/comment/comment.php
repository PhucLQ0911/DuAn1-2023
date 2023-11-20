<?php
require_once '../dao/pdo.php';


function commentCountById($id)
{
  $sql = "SELECT COUNT(id_pro) FROM comment WHERE id_pro=$id";
  return pdo_query_value($sql);
}

function commentGetAll()
{
  $sql = "SELECT DISTINCT p.name,p.image,c.id_pro FROM comment c
    LEFT JOIN product p ON c.id_pro = p.id";
  return pdo_query($sql);
}


function commentGetDetail($id)
{
  $sql = "SELECT u.user_name,c.content,c.added_on,c.id FROM comment c
    LEFT JOIN user u  ON c.id_user = u.id
    where id_pro=?";
  return pdo_query($sql, $id);
}

function commentDelete($id)
{
  $sql = "DELETE FROM `comment` WHERE `id`=$id";
  pdo_execute($sql);
}


function commentGetCountForProduct($id)
{
  $sql = "SELECT COUNT(`id`) FROM `comment` WHERE `id_pro`=$id";
  return pdo_query_value($sql);
}

function commentGetAllForProduct($id)
{
  $sql = "SELECT `comment`.id, `comment`.content, `comment`.id_pro, `comment`.added_on,
  `user`.fullname, `user`.`image` 
  FROM `comment`
  LEFT JOIN `user` 
    ON `user`.id =`comment`.id_user 
  WHERE `id_pro`=$id 
  ORDER BY `comment`.id DESC";
  return pdo_query($sql);
}