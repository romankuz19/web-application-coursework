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

  <div class="container">

  <div class="inside-container d-flex flex-wrap">

  <?php
  
  
  $query = $pdo->query("SELECT * FROM `alivebutterfly` ORDER BY `typename`");
  
  

  while($row = $query->fetch(PDO::FETCH_OBJ)){
    $typename=$row->typename;
    $query1 = $pdo->query("SELECT * FROM `types` WHERE `originalname`='$typename' ORDER BY `originalname`");
    $row1 = $query1->fetch(PDO::FETCH_OBJ);

    if(($row->amount)>0){
      $text="Есть в наличии";
      $order="/makebutterflyorder.php";
      $button="Заказать";
    }
    else{
      $text="Нет в наличии";
      $order="/notavailable.php";
      $button="Уведомить";
    }

echo'
<div class="card  mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
    
      <img src="data:image;base64,'.$row->img.'" class="rounded-start" alt="...">
     </div>
   <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title new">Вид :  <a href="/aboutbutterfly.php?id='.$row1->id.'" class="linktoecn text-decoration-none">'.$row->typename.' <br> ('.$row1->translatedname.') </a></h5>
        <p class="card-text new">Цена : '.$row->price.' руб.</p>
        <p class="card-text new">Количество : '.$row->amount.' шт.</p>

        <p class="card-text new">Средняя длительность жизни : '.$row->lifetime.' дней</p>
        <p class="card-text new">Размеры : '.$row->size.' см</p>

        <div class="card-body">
        <h4 class="text-center new">
        <a href="'.$order.'?id='.$row->id.'" class="card-link text-decoration-none m-0 ">'.$button.'</a>
        </h4>
        </div>

        
      </div>
    </div>
  </div>
</div>';


  }


    

  

?>

  </div>

  </div>
    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
