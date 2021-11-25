<?php
  require 'configDB.php';
  $parrotname = filter_var(trim($_POST['parrotname']),FILTER_SANITIZE_STRING);
  $cagename = filter_var(trim($_POST['cagename']),FILTER_SANITIZE_STRING);
  $providername = filter_var(trim($_POST['providername']),FILTER_SANITIZE_STRING);

  

  $sql = "DELETE FROM `parrots` WHERE `name` = '$parrotname'";
  $query = $pdo->prepare($sql);
  $query->execute([$id]);

  $sql = "DELETE FROM `cages` WHERE `name` = '$cagename'";
  $query = $pdo->prepare($sql);
  $query->execute([$id]);

  $sql = "DELETE FROM `providers` WHERE `name` = '$providername'";
  $query = $pdo->prepare($sql);
  $query->execute();


  header('Location: /ordersuccess.php');
?>
