<?php
$parrottype = filter_var(trim($_POST['parrottype']),FILTER_SANITIZE_STRING);
$descr = filter_var(trim($_POST['descr']),FILTER_SANITIZE_STRING);

$cagename = filter_var(trim($_POST['cagename']),FILTER_SANITIZE_STRING);
$amount = filter_var(trim($_POST['amount']),FILTER_SANITIZE_STRING);


   require 'configDB.php';

     
          

           $query11 = $pdo->query("UPDATE `encyclopedia` SET `description`='$descr' WHERE `typename`= '$parrottype'");

           $query10 = $pdo->query("UPDATE `cages` SET `amount`='$amount' WHERE `name`= '$cagename'");
          
          
          
            //echo ''.$parrottype.' <br>';
            //echo ''.$descr.'<br>';
            
            
        
          
           header('Location: /ordersuccess.php');

		
?>
