<?php
require 'configDB.php';
$login = filter_var(trim($_POST['loginname']),FILTER_SANITIZE_STRING);
$username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
$parrotname = filter_var(trim($_POST['parrotname']),FILTER_SANITIZE_STRING);
$id = $_GET['id'];
echo ''.$login.'';
echo ''.$username.'';
echo ''.$parrotname.'';


$query = $pdo->query("SELECT * FROM `parrots` WHERE `name` = '$parrotname'");
$row = $query->fetch(PDO::FETCH_OBJ);
echo ''.$row->typename.'';

$parrotid=$row->id;
$parrotprice=$row->price;

echo ''.$parrotid.'';

$sql1 = 'SELECT * FROM `orders` WHERE `parrotid` = ?';
$query1 = $pdo->prepare($sql1);
$query1->execute([$id]);
$row1 = $query1->fetch(PDO::FETCH_OBJ);





$query2 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
$row2 = $query2->fetch(PDO::FETCH_OBJ);
$userid=$row2->id;

$orderid=0;

$query3 = $pdo->query("SELECT * FROM `orders`");
while($row3 = $query3->fetch(PDO::FETCH_OBJ)){
$orderid=$row3->id;
}
$orderid+=1;


echo '<br>'.$orderid.'';



    // $mysql=new mysqli('localhost','root','root','to-do');
    $mysql->query("INSERT INTO `orders`(`parrotid`, `userid`, `price`) VALUES ('$parrotid','$userid','$parrotprice')");
    

    $bool=0;
    // $mysql=new mysqli('localhost','root','root','to-do');
    $mysql->query("UPDATE `parrots` SET `available`='$bool' WHERE `id`=$parrotid");
    $mysql->close();

    // $mysql=new mysqli('localhost','root','root','to-do');
    // $mysql->query("UPDATE `users` SET `orderid`='$orderid' WHERE `id`=$userid");
    // $mysql->close();



    header('Location: /orders.php');
?>
