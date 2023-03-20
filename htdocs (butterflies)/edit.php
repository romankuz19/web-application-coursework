<?php
$dolltype = filter_var(trim($_POST['dolltype']),FILTER_SANITIZE_STRING);
$amountdoll = filter_var(trim($_POST['amountdoll']),FILTER_SANITIZE_STRING);

$buttype = filter_var(trim($_POST['buttype']),FILTER_SANITIZE_STRING);
$amountbut = filter_var(trim($_POST['amountbut']),FILTER_SANITIZE_STRING);

$editbutenc = filter_var(trim($_POST['editbutenc']),FILTER_SANITIZE_STRING);

$features = filter_var(trim($_POST['features']),FILTER_SANITIZE_STRING);


   require 'configDB.php';

     
          

           $query1 = $pdo->query("UPDATE `chrysalis` SET `amount`=$amountdoll WHERE `typename`= '$dolltype'");

           

           $query = $pdo->query("UPDATE `alivebutterfly` SET `amount`= $amountbut WHERE `typename`= '$buttype'");




           $query5 = $pdo->query("SELECT * FROM `types` WHERE `originalname` = '$editbutenc' ");
           $row5 = $query5->fetch(PDO::FETCH_OBJ);
           $id=$row5->id;
       
           $query2 = $pdo->query("INSERT INTO `aboutbutterfly` (`typeid`,`features`,`typename`) VALUES ($id,'$features','$editbutenc')");
          
          
          
            // echo ''.$dolltype.' <br>';
            // echo ''.$amountdoll.'<br>';

            // echo ''.$buttype.' <br>';
            // echo ''.$amountbut.'<br>';
            
            echo ''.$id.' <br>';
            echo ''.$habitat.' <br>';
            echo ''.$features.'<br>';
            echo ''.$editbutenc.'<br>';
           
            
        
          
         header('Location: /ordersuccess.php');

		
?>
