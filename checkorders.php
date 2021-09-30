<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css.css">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Просмотр заказов</title>
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


      <?php
          require 'configDB.php';
           $query4 = $pdo->query("SELECT * FROM `users` WHERE `online` = 1");
           $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <div class="card-container d-flex justify-content-evenly">
    <?php
      require 'configDB.php';
      
     
      $query = $pdo->query("SELECT * FROM `orders` WHERE `isfinished` =0");
      $row = $query->fetch(PDO::FETCH_OBJ);
      
      if($row){
    
      do {


        
        $parrotid=$row->parrotid;
        $query1 = $pdo->query("SELECT * FROM `parrots` WHERE `id`= '$parrotid'");
        $row1 = $query1->fetch(PDO::FETCH_OBJ);

        $userid=$row->userid;
        $query2 = $pdo->query("SELECT * FROM `users` WHERE `id`= '$userid'");
        $row2 = $query2->fetch(PDO::FETCH_OBJ);

        $cageid=$row->cageid;
        $query3 = $pdo->query("SELECT * FROM `cages` WHERE `id`= '$cageid'");
        $row3 = $query3->fetch(PDO::FETCH_OBJ);

        


      echo '<div class="card d-flex justify-content-center" style="width: 18rem;">';
 
       echo '<img src="data:image;base64,'.$row1->img.''.$row3->img.'" class="card-img-top imgcage" alt="...">';
       echo  '<div class="card-body">';
       echo '<h5 class="card-title">Наименование : '.$row1->name.''.$row3->name.'</h5>';
       echo '<h5 class="card-title">Имя заказчка : '.$row2->name.'</h5>';
       echo '<h5 class="card-title">Логин заказчка : '.$row2->login.'</h5>';
       
      echo '</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Вид попугая : '.$row1->typename.''.$row3->typemename.'</li>
        <li class="list-group-item">Цена : '.$row1->price.''.$row3->price.' руб.</li>
        
      </ul>';
      echo ' <form class="form1 invisible" action="/closeorder.php" method="post" >

       <input type="number" class="form-control" name="parrotid" id="parrotid" value="'.$parrotid.'"> 
  
      <input type="number" class="form-control" name="userid" id="userid" value="'.$userid.'">  
      <input type="text" class="form-control visible" name="isaccepted" id="isaccepted" placeholder="Заказ получен?(Да/Нет)">
  
      <input type="number" class="form-control" name="cageid" id="cageid" value="'.$cageid.'">

      
      
       <div class="d-flex justify-content-center">
           
       <button class="btn btn-danger visible"  type="submit">Закрыть заказ</button> 
       </div>
  
       </form>
       </div>';
        

    } while($row = $query->fetch(PDO::FETCH_OBJ));
}
else{
    echo    '<h1>Нет заказов</h1>';
}


    
    ?>
 </div>
 
  </div>
 
            <?php endif;?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
