<?php
$parrotname = filter_var(trim($_POST['parrotname']),FILTER_SANITIZE_STRING);
$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$providername = filter_var(trim($_POST['providername']),FILTER_SANITIZE_STRING);
$shortdiscr = filter_var(trim($_POST['shortdiscr']),FILTER_SANITIZE_STRING);
$parrotsize = filter_var(trim($_POST['parrotsize']),FILTER_SANITIZE_STRING);
$parrotweight = filter_var(trim($_POST['parrotweight']),FILTER_SANITIZE_STRING);
$parrotprice = filter_var(trim($_POST['parrotprice']),FILTER_SANITIZE_STRING);

// echo ''.$parrotname.'';
// echo ''.$typmename.'';
// echo ''.$providername.'';
// echo ''.$shortdiscr.'';
// echo ''.$parrotsize.'';
// echo ''.$parrotweight.'';
// echo ''.$parrotprice.'';

   require 'configDB.php';
   
    // $query10 = $pdopdo->query("INSERT INTO `parrots` (`img`) VALUES (null)");
    
     $query10 = $pdo->query("INSERT INTO `parrots` (`name`) VALUES ('$parrotname')");
    
    
   
           
    
    
      $query = $pdo->query("SELECT * FROM `types` WHERE `name`= '$typename'");
     
      $query1 = $pdo->query("SELECT * FROM `providers` WHERE `name`= '$providername'");

      if($row = $query->fetch(PDO::FETCH_OBJ)){
        $typeid=$row->id;
        if($row1 = $query1->fetch(PDO::FETCH_OBJ)){
          $query2 = $pdo->query("SELECT * FROM `cages` WHERE `typeid`= '$typeid'");
          $row2 = $query2->fetch(PDO::FETCH_OBJ);
          $cageid=$row2->id;
          $providerid=$row1->id;

           $query11 = $pdo->query("UPDATE `parrots` SET `typename`='$typename' , `providername`='$providername' , `info`='$shortdiscr' , `typesid`='$typeid' , `size`='$parrotsize' , `weight`='$parrotweight' , `price`='$parrotprice' , `available`=1,`providerid`='$providerid'  WHERE `name`= '$parrotname'");
          
          
          
            echo ''.$parrotname.' <br>';
            echo ''.$typename.'<br>';
            echo ''.$providername.'<br>';
            echo ''.$shortdiscr.'<br>';
            echo ''.$typeid.'<br>';
            echo ''.$parrotsize.'<br>';
            echo ''.$parrotweight.'<br>';
            echo ''.$cageid.'<br>';
            echo ''.$parrotprice.'<br>';
            echo ''.$providerid.'<br>';
            
            
            $image = addslashes($_FILES['myfile']['tmp_name']);
            $name  = addslashes($_FILES['myfile']['tmp_name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);


            $stmt=$pdo->prepare("UPDATE `parrots` SET `img` = '$image' WHERE `name`= '$parrotname'");
            $stmt->execute();
             header('Location: /ordersuccess.php');


        }
        else{
          echo 'Неправильный поставщик!';
        }
        
      }
      else{
        echo 'Неправильный вид попугая!';
      }
      
    
  
    
    
		
?>
