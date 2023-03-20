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
  <title>Просмотр заказов</title>
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


      <?php
          require 'configDB.php';
          $currentuser=$_SESSION['name'];
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
           $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <div class="card-container d-flex flex-wrap justify-content-evenly">
    <?php
      require 'configDB.php';
      
     
      $query = $pdo->query("SELECT * FROM `orders` WHERE `isfinished` = 0");
      $query10 = $pdo->query("SELECT * FROM `orders` WHERE `isfinished` = 0");
      $row10 = $query10->fetch(PDO::FETCH_OBJ);
      
      if($row10){
        $counterbut=1;
        $counterdoll=1;
        while($row = $query->fetch(PDO::FETCH_OBJ)){
        $userid=$row->userid;
        $query2 = $pdo->query("SELECT * FROM `users` WHERE `id`= '$userid'");
        $row2 = $query2->fetch(PDO::FETCH_OBJ);

        $dollid=$row->dollid;
        $query3 = $pdo->query("SELECT * FROM `chrysalis` WHERE `id`= '$dollid'");
        $row3 = $query3->fetch(PDO::FETCH_OBJ);

        
        $butid=$row->butid;
        $query1 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `id`= '$butid'");
        $row1 = $query1->fetch(PDO::FETCH_OBJ);


        if($row1){
          
          echo '<div class="card d-flex  justify-content-center" style="width: 18rem; margin-bottom:1%">';
 
       echo '<img src="data:image;base64,'.$row1->img.'" class="card-img-top imgcage" alt="...">';
       echo  '<div class="card-body">';
       
       echo '<h5 class="card-title">Имя заказчка : '.$row2->name.'</h5>';
       echo '<h5 class="card-title">Логин заказчка : '.$row2->login.'</h5>';
       
      echo '</div>
      <ul class="list-group list-group-flush">
      
        <li class="list-group-item">Вид бабочки : '.$row1->typename.'</li>
        <li class="list-group-item">Цена : '.$row->price.' руб.</li>
        <li class="list-group-item">Количество : '.$row->orderedamount.'</li>
        
      </ul>';
      echo ' <form class="form1 invisible" action="/closeorder.php" method="post" >

       <input type="number" class="form-control d-none" name="butid" id="butid" value="'.$butid.'"> 
  
      <input type="number" class="form-control d-none" name="userid" id="userid" value="'.$userid.'"> 
      
      <input type="text" class="form-control visible" name="isaccepted" id="isacceptedbut'.$counterbut.'" >

      <h6 class="visible text-center">Заказ получен?</h6> 
      <div class="d-flex justify-content-center" style="padding-bottom:10px">
      
      <a class="btn btn-warning visible" id="yes" onclick="setYesBut('.$counterbut.')">Да</a> 
      <a class="btn btn-dark visible" id="no" onclick="setNoBut('.$counterbut.')" >Нет</a> 
        
      </div>
       <div class="d-flex justify-content-center">
         
       <button class="btn btn-success visible"  type="submit">Закрыть заказ</button> 
       </div>
  
       </form>
       </div>';
       $counterbut++;
       
          
        }
        else{
          
          echo '<div class="card d-flex  justify-content-center" style="width: 18rem; margin-bottom:1%">';
 
       echo '<img src="data:image;base64,'.$row3->img.'" class="card-img-top imgcage" alt="...">';
       echo  '<div class="card-body">';
       
       echo '<h5 class="card-title">Имя заказчка : '.$row2->name.'</h5>';
       echo '<h5 class="card-title">Логин заказчка : '.$row2->login.'</h5>';
       
      echo '</div>
      <ul class="list-group list-group-flush">
      
        <li class="list-group-item">Вид куколки : '.$row3->typename.'</li>
        <li class="list-group-item">Цена : '.$row->price.' руб.</li>
        <li class="list-group-item">Количество : '.$row->orderedamount.'</li>
        
      </ul>';
      echo ' <form class="form1 invisible" action="/closeorder.php" method="post" >

       <input type="number" class="form-control d-none" name="dollid" id="dollid" value="'.$dollid.'"> 
  
      <input type="number" class="form-control d-none" name="userid" id="userid" value="'.$userid.'"> 
      
      <input type="text" class="form-control visible" name="isaccepted" id="isaccepteddoll'.$counterdoll.'" >

      <h6 class="visible text-center">Заказ получен?</h6> 
      <div class="d-flex justify-content-center" style="padding-bottom:10px">
      
      <a class="btn btn-warning visible" id="yes" onclick="setYesDoll('.$counterdoll.')">Да</a> 
      <a class="btn btn-dark visible" id="no" onclick="setNoDoll('.$counterdoll.')" >Нет</a> 
        
      </div>
       <div class="d-flex justify-content-center">
         
       <button class="btn btn-success visible"  type="submit">Закрыть заказ</button> 
       </div>
  
       </form>
       </div>';
       $counterdoll++;
        }


    } 
}
else{
    echo    '<h1>Нет заказов</h1>';
}


    
    ?>
 </div>
 
  </div>
 
            <?php endif;?>

    <script>
     
    function setYesBut(id){
    
      var some="isacceptedbut"+id;
      var elem = document.getElementById(some);
      elem.value="Да";

    }
    function setNoBut(id){

      var some="isacceptedbut"+id;
      var elem = document.getElementById(some);
      elem.value="Нет";
      
    }
    function setYesDoll(id){
    
    var some="isaccepteddoll"+id;
    var elem = document.getElementById(some);
    elem.value="Да";

  }
  function setNoDoll(id){
    
    var some="isaccepteddoll"+id;
    var elem = document.getElementById(some);
    elem.value="Нет";

  }
  </script> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
