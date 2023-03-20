<?php
$butid = filter_var(trim($_POST['butid']),FILTER_SANITIZE_STRING);
$userid = filter_var(trim($_POST['userid']),FILTER_SANITIZE_STRING);
$dollid = filter_var(trim($_POST['dollid']),FILTER_SANITIZE_STRING);
$isaccepted = filter_var(trim($_POST['isaccepted']),FILTER_SANITIZE_STRING);

   require 'configDB.php';

    $countid;
   $query2 = $pdo->query("SELECT * FROM `users` WHERE `id`= '$userid'");
   $row2 = $query2->fetch(PDO::FETCH_OBJ);
    
   $query1 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `id`= '$butid'");

   $query3 = $pdo->query("SELECT * FROM `chrysalis` WHERE `id`= '$dollid'");

   $query5 = $pdo->query("SELECT * FROM `orders`");
   if($row1 = $query1->fetch(PDO::FETCH_OBJ)){
    $query6 = $pdo->query("SELECT * FROM `orders` WHERE `butid`= '$butid' AND `userid`= '$userid' AND `isfinished`=0");
    $row6 = $query6->fetch(PDO::FETCH_OBJ);
    if($isaccepted=="Да"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=1 WHERE `butid`= '$butid' AND `userid`= '$userid' AND `isfinished`=0");
    }
    else if($isaccepted=="Нет"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `butid`= '$butid' AND `userid`= '$userid' AND `isfinished`=0");
        $query10 = $pdo->query("UPDATE `alivebutterfly` SET `amount`=$row1->amount+$row6->orderedamount WHERE `id`= '$butid'");
    }
   }
   else if($row3 = $query3->fetch(PDO::FETCH_OBJ)){
    $query6 = $pdo->query("SELECT * FROM `orders` WHERE `dollid`= '$dollid' AND `userid`= '$userid' AND `isfinished`=0");
    $row6 = $query6->fetch(PDO::FETCH_OBJ);
    if($isaccepted=="Да"){
    $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=1 WHERE `dollid`= '$dollid' AND `userid`= '$userid' AND `isfinished`=0");
    }
    else if($isaccepted=="Нет"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `dollid`= '$dollid' AND `userid`= '$userid' AND `isfinished`=0");
        $query10 = $pdo->query("UPDATE `chrysalis` SET `amount`=$row3->amount+$row6->orderedamount WHERE `id`= '$dollid'");
    }
   }

    header('Location: /checkorders.php');

	
?>
