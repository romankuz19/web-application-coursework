<?php
require 'configDB.php';
$login = filter_var(trim($_POST['loginname']),FILTER_SANITIZE_STRING);
$username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
$phonenumber = filter_var(trim($_POST['phonenumber']),FILTER_SANITIZE_STRING);
$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$id = $_GET['id'];


$query2 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
$row2 = $query2->fetch(PDO::FETCH_OBJ);
$userid=$row2->id;




echo '<br>'.$login.'';
echo '<br>'.$username.'';
echo '<br>'.$phonenumber.'';
echo '<br>'.$typename.'';
echo '<br>'.$userid.'';




$query11 = $pdo->query("UPDATE `notification` SET `iscompleted`=1  WHERE `userlogin`= '$login' AND `userphone`= '$phonenumber' AND `iscompleted`=0");



   header('Location: /ordersuccess.php');
?>
