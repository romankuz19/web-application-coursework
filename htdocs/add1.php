<?php
$cagename = filter_var(trim($_POST['cagename']),FILTER_SANITIZE_STRING);
$typename1 = filter_var(trim($_POST['typename1']),FILTER_SANITIZE_STRING);
$cageprice = filter_var(trim($_POST['cageprice']),FILTER_SANITIZE_STRING); 
$cageamount = filter_var(trim($_POST['cageamount']),FILTER_SANITIZE_STRING);

   require 'configDB.php';

    
    $query10 = $pdo->query("INSERT INTO `cages` (`name`) VALUES ('$cagename')");
    
    
      $query = $pdo->query("SELECT * FROM `types` WHERE `name`= '$typename1'");
     
      if($row = $query->fetch(PDO::FETCH_OBJ)){
        $typeid=$row->id;
        
          

           $query11 = $pdo->query("UPDATE `cages` SET `typmename`='$typename1' , `typeid`= $typeid , `price`= $cageprice , `amount`=$cageamount WHERE `name`= '$cagename'");
          
          
          
            // echo ''.$parrotname.' <br>';
            // echo ''.$typename.'<br>';
            // echo ''.$providername.'<br>';
            // echo ''.$shortdiscr.'<br>';
             //echo ''.$typeid.'<br>';
            // echo ''.$parrotsize.'<br>';
            // echo ''.$parrotweight.'<br>';
            // echo ''.$cageid.'<br>';
            // echo ''.$parrotprice.'<br>';
            
            
            $image = addslashes($_FILES['myfile']['tmp_name']);
            $name  = addslashes($_FILES['myfile']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);


            $stmt=$pdo->prepare("UPDATE `cages` SET `img` = '$image' WHERE `name`= '$cagename'");
            $stmt->execute();
          
            header('Location: /ordersuccess.php');

        
        
        
      }
      else{
        echo 'Неправильный вид попугая!';
      }
      
    
  
    
    
		
?>
