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
