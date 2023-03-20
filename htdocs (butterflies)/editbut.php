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
  <title>Редактирование</title>
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
  <div class="container w-50">

  <div class="inside-container">
  

  <div class="type-container d-flex justify-content-between">
      <div class="container2">
      <div class="dropdown">
      <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Выберите вид бабочки
      </a>
      <?php
             require 'configDB.php';
             $query = $pdo->query("SELECT * FROM `alivebutterfly`");
               
             echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
             $countnames=1;
             while($row = $query->fetch(PDO::FETCH_OBJ)){
            echo '<li><a class="dropdown-item" style="cursor:pointer" id="linkbut'.$countnames.'" onclick="setTypeBut('.$countnames.')">'.$row->typename.'</a></li>';
            $countnames++;
             }
             echo '</ul>';
             echo '';
        ?>    
    </div>
    <br>
    <br>
      </div>
  
      

      <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <form class="form1 w-75" action="/edit.php" method="post" enctype="multipart/form-data">

            
<input type="text" class="form-control" name="buttype" id="buttype" placeholder="Введите вид бабочек, количество которых нужно изменить"> <br>

<input type="text" class="form-control" name="amountbut" placeholder="Введите новое количество"> <br>


<div class="d-flex justify-content-center">
<button class="btn btn-warning" type="submit" name="upload">Применить редактирование</button> <br>
</div>
</form>
            <?php endif;?>
  
  </div>
  </div>
  <div class="inside-container">
  

  <div class="type-container d-flex justify-content-between">
      <div class="container2">
      <div class="dropdown">
      <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Выберите вид куколки
      </a>
      <?php
             require 'configDB.php';
             $query1 = $pdo->query("SELECT * FROM `chrysalis`");
               
             echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
             $countnames1=1;
             while($row1 = $query1->fetch(PDO::FETCH_OBJ)){
            echo '<li><a class="dropdown-item" style="cursor:pointer" id="linkdoll'.$countnames1.'" onclick="setTypeDoll('.$countnames1.')">'.$row1->typename.'</a></li>';
            $countnames1++;
             }
             echo '</ul>';
             echo '';
        ?>    
    </div>
    <br>
    <br>
      </div>
  
      

      <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <form class="form1 w-75" action="/edit.php" method="post" enctype="multipart/form-data">

            
<input type="text" class="form-control" name="dolltype" id="dolltype" placeholder="Введите вид куколок, количество которых нужно изменить"> <br>

<input type="text" class="form-control" name="amountdoll" placeholder="Введите новое количество"> <br>


<div class="d-flex justify-content-center">
<button class="btn btn-warning" type="submit" name="upload">Применить редактирование</button> <br>
</div>
</form>
            <?php endif;?>
  
  </div>
  </div>
  </div>
  </div>

  
      
 

  <script>
    function setTypeBut(id){

      var some="linkbut"+id;
      
      var elem = document.getElementById(some);
      var value=elem.innerHTML;
      var settype=document.getElementById("buttype");
  
      settype.value=value;
    }
    function setTypeDoll(id){

    var some="linkdoll"+id;

    var elem = document.getElementById(some);
    var value=elem.innerHTML;
    var settype=document.getElementById("dolltype");

    settype.value=value;
    }
    

  </script>          
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
