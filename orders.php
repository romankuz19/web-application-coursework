<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Заказы</title>
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
           $query4 = $pdo->query("SELECT * FROM `users` WHERE `online` = 1");
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

  <div class="container">

  <div class="inside-container">
  <h4 class="title text-center">
    
    
  </h4>

  <div class="type-container d-flex justify-content-between">
    <div class="dropdown">
      <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Выберите, что вам нужно
      </a>

      <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="/orderparrot.php">Попугаи</a></li>
        <li><a class="dropdown-item" href="/ordercage.php">Клетки</a></li>
      </ul>
    </div>

    <?php

   
   require 'configDB.php';
   $id = $_GET['id'];

 $sql = 'SELECT * FROM `parrots` WHERE `id` = ?';
 $query = $pdo->prepare($sql);
 $query->execute([$id]);
 $query1 = $pdo->prepare($sql);
 $query1->execute([$id]);
  $row1 = $query1->fetch(PDO::FETCH_OBJ);

  $sql3 = 'SELECT * FROM `orders` WHERE `parrotid` = ?';
  $query3 = $pdo->prepare($sql3);
  $query3->execute([$id]);
  $row3 = $query3->fetch(PDO::FETCH_OBJ);
  $userid=$row3->userid;

  // $sql4 = "SELECT * FROM `users` WHERE `id` = $uderid";
  // $query4 = $pdo->prepare($sql4);
  // $query4->execute([$userid]);
  // $row4 = $query4->fetch(PDO::FETCH_OBJ);
 

  $query4 = $pdo->query("SELECT * FROM `users` WHERE `online` = 1");
 
  $row4 = $query4->fetch(PDO::FETCH_OBJ);


 
   echo '<form class="form1 d-flex flex-column justify-content-center" action="/sendorderparrot.php?id='.$row1->id.'" method="post">
   <h6 class="text-center">Ваша бронь:</h6>
   <div class="mb-3">
     <label for="exampleInputEmail1" class="form-label">Ваше имя</label>
     <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="'.$row4->name.'" >
     
   </div>
   <div class="mb-3">
     <label for="exampleInputEmail2" class="form-label">Ваш логин</label>
     <input type="text" class="form-control" name="loginname" id="exampleInputEmail2" aria-describedby="emailHelp" value="'.$row4->login.'" readonly>
     
   </div>
   <div class="mb-3">
     <label for="exampleInputEmail3" class="form-label">Имя попугая</label>
     <input type="text" class="form-control" name="parrotname" id="exampleInputEmail3" value="'.$row1->name.'" aria-describedby="emailHelp" readonly>
     
   </div>
   <div class="mb-3">
     <label for="exampleInputPassword1" class="form-label">Цена</label>
     <input type="text" class="form-control" id="exampleInputPassword1" readonly value="'.$row1->price.' руб.">
   </div>
   
   <button type="submit" class="btn btn-primary">Забронировать</button>
 </form>';
   

 
      $sql5 = "SELECT * FROM `parrots` WHERE `typesid` = $id";
      $query5 = $pdo->prepare($sql5);
      $query5->execute([$id]);
      
   while($row = $query->fetch(PDO::FETCH_OBJ)) {


    if(($row->available)==true){
      $text="Есть в наличии";
      $order="/orders.php";
    }
    else{
      $text="Нет в наличии";
      $order="/";
    }
    
    $row5 = $query5->fetch(PDO::FETCH_OBJ);
  echo '<div class="card d-flex justify-content-center" style="width: 18rem;">';
  $db = mysqli_connect("localhost","root","root","to-do"); 
    $sql = "SELECT * FROM `parrots` WHERE `typesid`=$id";
    
    $sth = $db->query($sql);
    $result=mysqli_fetch_array($sth);
   echo '<img src="data:image;base64,'.$row->img.'" class="card-img-top" alt="...">';
   echo  '<div class="card-body">';
   echo '<h5 class="card-title">Имя : '.$row->name.'</h5>';
  echo '</div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Вид попугая : '.$row->typename.'</li>
    <li class="list-group-item">Поставщик : '.$row->providername.'</li>
    <li class="list-group-item">Размеры : '.$row->size.' см</li>
    <li class="list-group-item">Вес : '.$row->weight.' г</li>
    <li class="list-group-item">Цена : '.$row->price.' руб.</li>
  </ul>';

  $id1 = $_GET['id'];
  $sql7 = 'SELECT * FROM `cages` WHERE `typeid` = ?';
  $query7 = $pdo->prepare($sql1);
  $query7->execute([$id]);
  $row7= $query7->fetch(PDO::FETCH_OBJ);

  echo '<div class="card-body">
    <a href="/encyclopedia.php?id='.$row->id.'" class="card-link text-decoration-none">Подробнее про данный вид</a> <br> <br>
    <a href="/parrots.php?id='.$row->typesid.'" class="card-link text-decoration-none m-0">Подбронее в каталоге</a> <br> <br>
    <a href="/cages.php?id='.$row->typesid.'" class="card-link text-decoration-none m-0">Смотреть клетку для этого попугая</a> <br>
    
  </div>
</div>';
}
          
    ?>

<?php
      require 'configDB.php';
      
      $id = $_GET['id'];

    $sql = 'SELECT * FROM `cages` WHERE `typeid` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    

    ?>

  </div>
      

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
