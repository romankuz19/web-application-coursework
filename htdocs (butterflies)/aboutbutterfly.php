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
  <title>Администрирование</title>
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
    $id = $_GET['id'];
    if($id):
        $query = $pdo->query("SELECT * FROM `types` WHERE `id` = $id");
        $query1 = $pdo->query("SELECT * FROM `aboutbutterfly` WHERE `typeid` = $id");
        $query2 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `typeid` = $id");
        $query3 = $pdo->query("SELECT * FROM `chrysalis` WHERE `typeid` = $id");
        $row = $query->fetch(PDO::FETCH_OBJ);
        $row1 = $query1->fetch(PDO::FETCH_OBJ);
        $row2 = $query2->fetch(PDO::FETCH_OBJ);
        $row3 = $query3->fetch(PDO::FETCH_OBJ);
        
       echo'
       <div class="container-enc1 d-flex justify-content-evenly">
       <div class="card" style="width: 18rem;">
    <img src="data:image;base64,'.$row2->img.'" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><strong><em>'.$row1->typename.'</em></strong><br>(живая бабочка)</h5>
      <p class="card-text">Размеры : около '.$row2->size.' см</p>
      <p class="card-text">Средняя продолжительность жизни : '.$row2->lifetime.' дней</p>
      
      <p class="card-text">Особенности : '.$row1->features.' </p>
      <a href="/index.php?id='.$id.'" class="btn btn-dark">Смотреть в каталоге</a>
    </div>
  </div>';

  echo'
    
    <div class="card-body" style="max-width:500px;max-height:300px;border-radius:30px;">
      
      <p class="card-text">Среда обитания : '.$row2->habitat.' </p>
      
    </div>
  ';

  echo'<div class="card" style="width: 18rem;">
  <img src="data:image;base64,'.$row3->img.'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><strong><em>'.$row1->typename.'</em></strong><br>(куколка бабочки)</h5>
    
    <p class="card-text">Время превращения : '.$row3->timetoborn.' дней</p>
    
    <p class="card-text">Особенности : '.$row3->description.' </p>

    <a href="/butterflydolls.php?id='.$id.'" class="btn btn-dark">Смотреть в каталоге</a>
  </div>
</div>
</div>';
    ?>
    
    <?php else:

      
      echo '<br>  <br>   <h2 class="text-center"><strong>Все бабочки</strong></h2>
      <div class="inside-container d-flex flex-wrap justify-content-center">
      <div class="container-enc d-flex flex-wrap justify-content-evenly">';
      
      $query = $pdo->query("SELECT * FROM `alivebutterfly` ORDER BY `typename`");
  
  while($row = $query->fetch(PDO::FETCH_OBJ)){
    $typename=$row->typename;
    $query1 = $pdo->query("SELECT * FROM `types` WHERE `originalname`='$typename'");
    $row1 = $query1->fetch(PDO::FETCH_OBJ);

    $query2= $pdo->query("SELECT * FROM `aboutbutterfly` WHERE `typename`='$typename'");
    $row2 = $query2->fetch(PDO::FETCH_OBJ);

    
    
    echo'
    
    <div class="card" style="width: 18rem;margin-top:5px">
    <img src="data:image;base64,'.$row->img.'" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><strong><em>'.$row->typename.'</em></strong><br>(живая бабочки)</h5>
      <p class="card-text"><em>Размеры</em> : около '.$row->size.' см</p>
      <p class="card-text"><em>Средняя продолжительность жизни</em> : '.$row->lifetime.' дней</p>
      <p class="card-text"><em>Среда обитания</em> : '.$row->habitat.' </p>
      <p class="card-text"><em>Особенности</em> : '.$row2->features.' </p>
  
      <a href="/index.php?id='.$id.'" class="btn btn-dark">Смотреть в каталоге</a>
    </div>
  </div>';

  }
  echo '
  </div>
  </div>';

  echo '<br>  <br>   <h2 class="text-center"><strong>Все куколки</strong></h2>
      <div class="inside-container d-flex flex-wrap justify-content-center">
      <div class="container-enc d-flex flex-wrap justify-content-evenly">';
  
  $query = $pdo->query("SELECT * FROM `chrysalis` ORDER BY `typename`");

while($row = $query->fetch(PDO::FETCH_OBJ)){
$typename=$row->typename;
$query1 = $pdo->query("SELECT * FROM `types` WHERE `originalname`='$typename'");
$row1 = $query1->fetch(PDO::FETCH_OBJ);

$query2= $pdo->query("SELECT * FROM `aboutbutterfly` WHERE `typename`='$typename'");
$row2 = $query2->fetch(PDO::FETCH_OBJ);



echo'

<div class="card " style="width: 18rem;margin-top:5px">
<img src="data:image;base64,'.$row->img.'" class="card-img-top" alt="...">
<div class="card-body">
  <h5 class="card-title"><strong><em>'.$row->typename.'</em></strong><br>(куколка бабочки)</h5>
  
  <p class="card-text">Время превращения : '.$row->timetoborn.' дней</p>
    
    <p class="card-text">Особенности : '.$row->description.' </p>

  <a href="/butterflydolls.php" class="btn btn-dark">Смотреть в каталоге</a>
</div>
</div>';

}
echo '
</div>
</div>';

  
      ?>
      
      
      
      
      <?php endif;?>
    
    



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>