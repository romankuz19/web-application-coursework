<?php
require 'configDB.php';


    $bool=0;
    // $mysql=new mysqli('localhost','root','root','to-do');
    $mysql->query("UPDATE `parrots` SET `available`='$bool' WHERE `id`=3");
    $mysql->close();



   header('Location: /');
?>
