<?php

$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$shortdiscr = filter_var(trim($_POST['shortdiscr']),FILTER_SANITIZE_STRING);
$butamount = filter_var(trim($_POST['butamount']),FILTER_SANITIZE_STRING);
$butprice = filter_var(trim($_POST['butprice']),FILTER_SANITIZE_STRING);
$size = filter_var(trim($_POST['size']),FILTER_SANITIZE_STRING);
$lifetime = filter_var(trim($_POST['lifetime']),FILTER_SANITIZE_STRING);




   require 'configDB.php';
   
   
   $query = $pdo->query("SELECT * FROM `types` WHERE `originalname` = '$typename' ");


   
    $row = $query->fetch(PDO::FETCH_OBJ);

  

    $id=$row->id;
     
   $query10 = $pdo->query("INSERT INTO `alivebutterfly` (`typename` , `price` ,`amount`,`habitat`,`typeid`,`size`,`lifetime`) VALUES ('$typename',$butprice,$butamount,'$shortdiscr',$id,$size,$lifetime)");
    
    
  
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


            $stmt=$pdo->prepare("UPDATE `alivebutterfly` SET `img` = '$image' WHERE `typename`= '$typename'");
            $stmt->execute();
            header('Location: /ordersuccess.php');


       
      
    
  
    
    
		
?>
