<?php
$providername = filter_var(trim($_POST['providername']),FILTER_SANITIZE_STRING);
$providerinfo = filter_var(trim($_POST['providerinfo']),FILTER_SANITIZE_STRING);
$providerhistory = filter_var(trim($_POST['providerhistory']),FILTER_SANITIZE_STRING);


   require 'configDB.php';

     
          
   $query10 = $pdo->query("INSERT INTO `providers` (`name`,`info`,`history`) VALUES ('$providername','$providerinfo','$providerhistory')");
          
          
          
            //echo ''.$parrottype.' <br>';
            //echo ''.$descr.'<br>';
          
           header('Location: /ordersuccess.php');

		
?>
