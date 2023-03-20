<?php

$originalname = filter_var(trim($_POST['originalname']),FILTER_SANITIZE_STRING);
$translatedname = filter_var(trim($_POST['translatedname']),FILTER_SANITIZE_STRING);



   require 'configDB.php';
   
   
   $query10 = $pdo->query("INSERT INTO `types` (`originalname` , `translatedname`) VALUES ('$originalname','$translatedname')");
    

    header('Location: /ordersuccess.php');



		
?>
