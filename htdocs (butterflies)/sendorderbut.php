<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Бабочкин Дом</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid w-75">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="btn btn-dark" href="/">Живые бабочки</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-dark" href="/butterflydolls.php">Куколки бабочек</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-dark" href="/aboutbutterfly.php">Подробнее о бабочках</a>
        </li>
        
      </ul>
      <?php
          
          require 'configDB.php';
           $currentuser=$_SESSION['name'];
           $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
           $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($_COOKIE['user']==''):
        ?>
        <a class="btn btn-dark" href="/authorithation.php">Войти</a>
        <?php elseif($row4->admin == 1): ?>
          <a class="btn btn-dark" href="/administration.php">Администрирование</a>
          <a class="btn btn-dark" href="/orders.php">Заказы</a>
          <a class="btn btn-dark" href="/exit.php">Выход</a>
        <?php else: ?>
          <a class="btn btn-dark" href="/orders.php">Заказы</a>
          <a class="btn btn-dark" href="/exit.php">Выход</a>
        
        <?php endif;?>
        
      
    </div>
  </div>
</nav>
<?php
require 'configDB.php';
$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$totalprice = filter_var(trim($_POST['totalprice']),FILTER_SANITIZE_STRING);
$orderedamount = filter_var(trim($_POST['orderedamount']),FILTER_SANITIZE_STRING);
// $id = $_GET['id'];





$query = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `typename` = '$typename'");
$row = $query->fetch(PDO::FETCH_OBJ);


if(($row->amount)>$orderedamount){
    echo ''.$login.'';
echo ''.$username.'';
echo ''.$typename.'';
echo ''.$totalprice.'';
    $butid=$row->id;
    $leftamount=($row->amount)-$orderedamount;
    
    
    
    
    $query2 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
    $row2 = $query2->fetch(PDO::FETCH_OBJ);
    $userid=$row2->id;
    
    $orderid=0;
    
    // $query3 = $pdo->query("SELECT * FROM `orders`");
    // while($row3 = $query3->fetch(PDO::FETCH_OBJ)){
    // $orderid=$row3->id;
    // }
    // $orderid+=1;
    
    
    echo '<br>'.$orderid.'';
    
    
    
       
        $mysql->query("INSERT INTO `orders`(`butid`, `userid`, `price`,`orderedamount`) VALUES ($butid,$userid,$totalprice,$orderedamount)");
        
    
        // $bool=0;
        
         $mysql->query("UPDATE `alivebutterfly` SET `amount`='$leftamount' WHERE `id`=$butid");
        $mysql->close();
    
       
    
    
    
        header('Location: /');
}
else{
    echo'<h1 class="text-center">Неверное количество</h1> <br>
    <h2 class="text-center"><a href="/butterflydolls.php">Вернуться назад</a></h2>';
}


?>
