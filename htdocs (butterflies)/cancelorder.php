
<?php
$butid = filter_var(trim($_POST['butid']),FILTER_SANITIZE_STRING);
$userid = filter_var(trim($_POST['userid']),FILTER_SANITIZE_STRING);
$dollid = filter_var(trim($_POST['dollid']),FILTER_SANITIZE_STRING);



echo ''.$parrotid.'';
echo ''.$userid.'';
echo ''.$cageid.'';


   require 'configDB.php';

    $countid;
   $query2 = $pdo->query("SELECT * FROM `users` WHERE `id`= '$userid'");
   $row2 = $query2->fetch(PDO::FETCH_OBJ);
    
   $query1 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `id`= '$butid'");
   $query3 = $pdo->query("SELECT * FROM `chrysalis` WHERE `id`= '$dollid'");

   $query5 = $pdo->query("SELECT * FROM `orders` WHERE `userid`= '$userid' AND `isfinished`=0 AND `butid`='$butid'");
   $row5 = $query5->fetch(PDO::FETCH_OBJ);

   $query6 = $pdo->query("SELECT * FROM `orders` WHERE `userid`= '$userid' AND `isfinished`=0 AND `dollid`='$dollid'");
   $row6 = $query6->fetch(PDO::FETCH_OBJ);

   



 


  
   if($row1 = $query1->fetch(PDO::FETCH_OBJ)){

        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `userid`= '$userid' AND `isfinished`=0 AND `butid`='$butid'");
        $query10 = $pdo->query("UPDATE `alivebutterfly` SET `amount`=$row1->amount+$row5->orderedamount WHERE `id`= '$butid'");
    
   }
   else if($row3 = $query3->fetch(PDO::FETCH_OBJ)){
       $amount=$row3->amount;
       $amount+=1;
    
    
        $query11 = $pdo->query("UPDATE `orders` SET `isfinished`=1 , `isaccepted`=0 WHERE `userid`= '$userid' AND `isfinished`=0 AND `dollid`='$dollid'" );
        $query10 = $pdo->query("UPDATE `chrysalis` SET `amount`=$row3->amount+$row6->orderedamount WHERE `id`= '$dollid'");
    
   }

    header('Location: /orders.php');

	
?>
