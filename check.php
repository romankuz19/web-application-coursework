<?php
 require 'configDB.php';
 


$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);





if(mb_strlen($login)<3|| mb_strlen($login)>90){
    echo "Error";
    exit();
}
else if(mb_strlen($name)<3|| mb_strlen($login)>50){
    echo "Error";
    exit();
}
else if(mb_strlen($pass)<2|| mb_strlen($pass)>10)
echo "Error";
    
$pass=md5($pass."passdp2545");

$mysql=new mysqli('localhost','root','root','to-do');
$mysql->query("INSERT INTO `users`(`login`, `pass`, `name`) VALUES ('$login','$pass','$name')");
$mysql->close();

header('Location: /');

?>
