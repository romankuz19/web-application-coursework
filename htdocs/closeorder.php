<?php
$parrotid = filter_var(trim($_POST['parrotid']),FILTER_SANITIZE_STRING);
$userid = filter_var(trim($_POST['userid']),FILTER_SANITIZE_STRING);
$cageid = filter_var(trim($_POST['cageid']),FILTER_SANITIZE_STRING);
$isaccepted = filter_var(trim($_POST['isaccepted']),FILTER_SANITIZE_STRING);

   require 'configDB.php';

    $countid;
   $query2 = $pdo->query("SELECT * FROM `users` WHERE `id`= '$userid'");
   $row2 = $query2->fetch(PDO::FETCH_OBJ);
    
   $query1 = $pdo->query("SELECT * FROM `parrots` WHERE `id`= '$parrotid'");
   $query3 = $pdo->query("SELECT * FROM `cages` WHERE `id`= '$cageid'");

   $query5 = $pdo->query("SELECT * FROM `orders`");

 


  
   if($row1 = $query1->fetch(PDO::FETCH_OBJ)){

    if($isaccepted=="Да"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=1 WHERE `parrotid`= '$parrotid' AND `userid`= '$userid' AND `isfinished`=0");
        // $query10 = $pdo->query("UPDATE `parrots` SET `available`=1 WHERE `id`= '$parrotid'");
    }
    else if($isaccepted=="Нет"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `parrotid`= '$parrotid' AND `userid`= '$userid' AND `isfinished`=0");
        $query10 = $pdo->query("UPDATE `parrots` SET `available`=1 WHERE `id`= '$parrotid'");
    }
    

   }
   else if($row3 = $query3->fetch(PDO::FETCH_OBJ)){
       $amount=$row3->amount;
       $amount+=1;
    if($isaccepted=="Да"){
    $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=1 WHERE `cageid`= '$cageid' AND `userid`= '$userid' AND `isfinished`=0");
    // $query10 = $pdo->query("UPDATE `cages` SET `amount`=$amount WHERE `id`= '$cageid'");
    }
    else if($isaccepted=="Нет"){
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `cageid`= '$cageid' AND `userid`= '$userid' AND `isfinished`=0");
        $query10 = $pdo->query("UPDATE `cages` SET `amount`=$amount WHERE `id`= '$cageid'");
    }
   }

    header('Location: /checkorders.php');

	
?>
