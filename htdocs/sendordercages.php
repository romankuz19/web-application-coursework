<?php
require 'configDB.php';
$login = filter_var(trim($_POST['loginname']),FILTER_SANITIZE_STRING);
$username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
$cagename = filter_var(trim($_POST['cagename']),FILTER_SANITIZE_STRING);
$id = $_GET['id'];


$query = $pdo->query("SELECT * FROM `cages` WHERE `name` = '$cagename'");
$row = $query->fetch(PDO::FETCH_OBJ);
echo ''.$cagename.'<br>';

$cageid=$row->id;
$cageprice=$row->price;
$cageamount=$row->amount;

echo ''.$cageid.'<br>';
echo ''.$cageprice.'<br>';

$sql1 = 'SELECT * FROM `orders` WHERE `cageid` = ?';
$query1 = $pdo->prepare($sql1);
$query1->execute([$id]);
$row1 = $query1->fetch(PDO::FETCH_OBJ);



$query2 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
$row2 = $query2->fetch(PDO::FETCH_OBJ);
$userid=$row2->id;

echo ''.$userid.'<br>';



    // $mysql=new mysqli('localhost','root','root','to-do');
    $mysql->query("INSERT INTO `orders`(`cageid`, `userid`, `price`) VALUES ('$cageid','$userid','$cageprice')");
    $mysql->close();

     $cageamount-=1;
    //  $mysql=new mysqli('localhost','root','root','to-do');
     $mysql->query("UPDATE `cages` SET `amount`='$cageamount' WHERE `id`=$cageid");
     $mysql->close();



   header('Location: /orders.php');
?>
