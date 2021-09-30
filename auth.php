<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <?php
require 'configDB.php';

$online=true;
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);


$pass=md5($pass."passdp2545");
$mysql=new mysqli('localhost','root','root','to-do');
$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
$user =$result->fetch_assoc();


$query1 = $pdo->query("UPDATE `users` SET `online`='$online' WHERE `login` = '$login'");

// if(count($user)==0){
//     echo "Error";
//     exit();
// }
setcookie('user',$user['name'],time()+3600, "/");
$mysql->close();


$query = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
$row = $query->fetch(PDO::FETCH_OBJ);



// echo ''.$login.'<br>';

// echo ''.$row->login.'<br>';



if($login == $row->login){
    
    header('Location: /');
    

}
else{

    echo '<h1 class="text-center">Такого пользователя не существует <br> <a class="link-primary text-decoration-none text-center" href="/">На главную</a></h1>'
    ;
    
}

?>
    </div>

</body>
</html>
