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
  <title>Заказы</title>
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
  <h4 class="title text-center">
    Ваши заказы
    <br> 
  </h4>
    <?php

   require 'configDB.php';
   $id = $_GET['id'];
   $query = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
    $row = $query->fetch(PDO::FETCH_OBJ); 
   $username = $row->login;
   $userid=$row->id;
   $query1 = $pdo->query("SELECT * FROM `orders` WHERE `isfinished` = 0 and `userid`= $userid");

   $query10 = $pdo->query("SELECT * FROM `orders` WHERE `isfinished` = 0 and `userid`= $userid");
   $row10 = $query10->fetch(PDO::FETCH_OBJ)

  ?>
  
        <?php
        
        if($row10){

  echo '<div class="card-container d-flex flex-wrap justify-content-evenly" >';
   while($row1 = $query1->fetch(PDO::FETCH_OBJ)) {
    
  
    $butid=$row1->butid;
    $dollid=$row1->dollid;
    
    if(!$butid){
      
     $query3 = $pdo->query("SELECT * FROM `chrysalis` WHERE `id` = $dollid");
     $row3 = $query3->fetch(PDO::FETCH_OBJ); 

     $query4 = $pdo->query("SELECT * FROM `types` WHERE `originalname` = '$row3->typename'");
     $row4 = $query4->fetch(PDO::FETCH_OBJ); 
    

     
  echo '<div class="card mb-3 d-flex justify-content-center" style="width: 18rem;">';
   echo '<img src="data:image;base64,'.$row3->img.'" class="card-img-top" alt="...">';
   echo  '<div class="card-body">';
  echo '<h5 class="card-title new">Вид куколки :  <a href="/butterflydolls.php" class="linktoecn text-decoration-none">'.$row3->typename.' <br> ('.$row4->translatedname.') </a></h5>';
  echo '</div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Количество : '.$row1->orderedamount.'</li>
    <li class="list-group-item">Цена : '.$row1->price.' руб.</li>
  </ul>';

  echo ' <form class="form1 invisible" action="/cancelorder.php" method="post" >
       <input type="number" class="form-control d-none" name="dollid" id="parrotid" value="'.$dollid.'"> 
      <input type="number" class="form-control d-none" name="userid" id="userid" value="'.$userid.'">  
      
       <div class="d-flex justify-content-center">
       <button class="btn btn-danger visible"  type="submit">Отмена заказа</button> 
       </div>
       </form>
       </div>';

    }
    else if(!$dollid){
      $query2 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `id` = $butid");
    $row2 = $query2->fetch(PDO::FETCH_OBJ); 

    $query5 = $pdo->query("SELECT * FROM `types` WHERE `originalname` = '$row2->typename'");
     $row5 = $query5->fetch(PDO::FETCH_OBJ); 


    echo '<div class="card mb-3 d-flex justify-content-center" style="width: 18rem;">';
    echo '<img src="data:image;base64,'.$row2->img.'" class="card-img-top" alt="...">';
    echo  '<div class="card-body">';
    echo '<h5 class="card-title new">Вид бабочки :  <a href="/" class="linktoecn text-decoration-none">'.$row2->typename.' <br> ('.$row5->translatedname.') </a></h5>';
   echo '</div>
   <ul class="list-group list-group-flush">
     <li class="list-group-item">Количество : '.$row1->orderedamount.'</li>
     <li class="list-group-item">Цена : '.$row1->price.' руб.</li>
   </ul>';

  
  echo ' <form class="form1 invisible" action="/cancelorder.php" method="post" >
       <input type="number" class="form-control d-none" name="butid" id="parrotid" value="'.$butid.'"> 
      <input type="number" class="form-control d-none" name="userid" id="userid" value="'.$userid.'">  
      
       <div class="d-flex justify-content-center">
       <button class="btn btn-danger visible"  type="submit">Отмена заказа</button> 
       </div>
  
       </form>
       </div>';


    }
      
}
        }
        else {
          echo'
          <h4 class="title text-center">
        Заказы отсутствуют!
        <br> 
          </h4>
          <h4 class="title text-center text-decoration-none">
          <a class="text-decoration-none" href="/">Быстрее делайте заказ!</a>
        <br> 
          </h4>';
        
        }
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
