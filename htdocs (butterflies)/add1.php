<?php

$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$shortdiscr = filter_var(trim($_POST['shortdiscr']),FILTER_SANITIZE_STRING);
$butamount = filter_var(trim($_POST['dollamount']),FILTER_SANITIZE_STRING);
$butprice = filter_var(trim($_POST['dollprice']),FILTER_SANITIZE_STRING);
 
$timetoborn = filter_var(trim($_POST['timetoborn']),FILTER_SANITIZE_STRING);


   require 'configDB.php';
   
   
   $query = $pdo->query("SELECT * FROM `types` WHERE `originalname` = '$typename' ");

   
    $row = $query->fetch(PDO::FETCH_OBJ);

    $id=$row->id;
     
   $query10 = $pdo->query("INSERT INTO `chrysalis` (`typename` , `price` ,`amount`,`description`,`timetoborn`,`typeid`) VALUES ('$typename',$butprice,$butamount,'$shortdiscr',$timetoborn,$id)");
    
    
  
    // $query11 = $pdo->query("UPDATE `alivebuttefly` SET  `price`='$butprice' , `description`='$shortdiscr' , `amount`='$butamount' , `butlifetime`='$butlifetime' WHERE `name`= '$typename'");
          
          
            echo ''.$id.'<br>';
            echo ''.$typename.' <br>';
            echo ''.$shortdiscr.'<br>';
            echo ''.$butamount.'<br>';
            echo ''.$butprice.'<br>';
            echo ''.$butlifetime.'<br>';
          
            
            
            $image = addslashes($_FILES['myfile']['tmp_name']);
            $name  = addslashes($_FILES['myfile']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);


            $stmt=$pdo->prepare("UPDATE `chrysalis` SET `img` = '$image' WHERE `typename`= '$typename'");
            $stmt->execute();
            header('Location: /ordersuccess.php');



		
?>
