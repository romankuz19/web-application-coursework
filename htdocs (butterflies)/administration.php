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

  <div class="container">

  <div class="inside-container">
  

  <div class="type-container d-flex justify-content-center">

  <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <div class="btn-group-vertical ">
                <a class="btn btn-light" href="/checkorders.php"> <strong>Просмотр заказов</strong></a> <br>
                <a class="btn btn-dark" href="/editenc.php"><strong>Редактировать энциклопедию</strong></a> <br>
                <a class="btn btn-dark" href="/editbut.php"><strong>Изменить количество бабочек или куколок</strong></a> <br>
                <a class="btn btn-warning" href="/addtype.php"><strong>Добавить вид</strong></a> <br>
                <a class="btn btn-warning" href="/addbut.php"><strong>Добавить бабочку</strong></a> <br>
                <a class="btn btn-warning" href="/adddoll.php"><strong>Добавить куколку</strong></a><br>
                <a class="btn btn-success" href="/deletebut.php"><strong>Убрать бабочку</strong></a> <br>
                <a class="btn btn-success" href="/deletedoll.php"><strong>Убрать куколку</strong></a>   <br>
                <a class="btn btn-success" href="/deletetype.php"><strong>Убрать вид</strong></a>   <br>
                

            </div>
            <?php endif;?>
  
 
  </div>
  
  
  </div>
    
   



  </div>
      

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
