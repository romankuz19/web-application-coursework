<?php
  require 'configDB.php';
  $buttype = filter_var(trim($_POST['buttype']),FILTER_SANITIZE_STRING);
  $dolltype = filter_var(trim($_POST['dolltype']),FILTER_SANITIZE_STRING);
  $providername = filter_var(trim($_POST['providername']),FILTER_SANITIZE_STRING); 
  $delbuttype = filter_var(trim($_POST['delbuttype']),FILTER_SANITIZE_STRING);

  

  $sql = "DELETE FROM `alivebutterfly` WHERE `typename` = '$buttype'";
  $query = $pdo->prepare($sql);
  $query->execute([$id]);

  $sql = "DELETE FROM `chrysalis` WHERE `typename` = '$dolltype'";
  $query = $pdo->prepare($sql);
  $query->execute([$id]);

  $sql = "DELETE FROM `types` WHERE `originalname` = '$delbuttype'";
  $query = $pdo->prepare($sql);
  $query->execute();


  header('Location: /ordersuccess.php');
?>
