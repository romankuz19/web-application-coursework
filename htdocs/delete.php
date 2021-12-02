<?php
$mysql=new mysqli('localhost','root','root','dbparrots');

if($mysql){

}
else
die(' База данных не найдена или отсутствует доступ.');
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Доабвить клетку</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid w-75">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a class="btn btn-primary" href="/">Попугаи от Кеши</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-primary" href="/cages.php">Клетки</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-primary" href="/providers.php">Наши поставщики</a>
        </li>
        <li class="nav-item">
        <a class="btn btn-primary" href="/encyclopedia.php">Энциклопедия</a>
        </li>
        
      </ul>
      <?php
          require 'configDB.php';
          $currentuser=$_SESSION['name'];
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
           $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($_COOKIE['user']==''):
        ?>
        <a class="btn btn-primary" href="/authorithation.php">Войти</a>
        <?php elseif($row4->admin == 1): ?>
          <a class="btn btn-primary" href="/administration.php">Администрирование</a>
          <a class="btn btn-primary" href="/orders.php">Заказы</a>
          <a class="btn btn-primary" href="/exit.php">Выход</a>
        <?php else: ?>
          <a class="btn btn-primary" href="/orders.php">Заказы</a>
          <a class="btn btn-primary" href="/exit.php">Выход</a>
        
        <?php endif;?>
        
      
    </div>
  </div>
</nav>
<?php
  require 'configDB.php';
  $parrotname = filter_var(trim($_POST['parrotname']),FILTER_SANITIZE_STRING);
  $cagename = filter_var(trim($_POST['cagename']),FILTER_SANITIZE_STRING);
  $providername = filter_var(trim($_POST['providername']),FILTER_SANITIZE_STRING);

  
   if($parrotname!=''){
    $sql = "DELETE FROM `parrots` WHERE `name` = '$parrotname'";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    header('Location: /ordersuccess.php');
   }       
  
   else if($cagename!=''){
    $sql = "DELETE FROM `cages` WHERE `name` = '$cagename'";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    header('Location: /ordersuccess.php');
   }
  
else if($providername!=''){
  $sql = "DELETE FROM `providers` WHERE `name` = '$providername'";
  $query = $pdo->prepare($sql);
  $query->execute();
  header('Location: /ordersuccess.php');
}
  
  else{
    echo '<h1 class="text-center">Некорректные данные!</h1>
    <h1 class="text-center"><a href="javascript: history.go(-1)">Назад</a></h1>';
    exit();
   }
?>
