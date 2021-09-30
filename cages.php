<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css.css">
  <title>Клетки</title>
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


  <div class="types-container d-flex justify-content-center">
  <?php
 
 require 'configDB.php';

 $query1 = $pdo->query('SELECT * FROM `types`');
 /* $row1 = $query1->fetch(PDO::FETCH_OBJ); */
 echo '<div class="btn-group pad" role="group" aria-label="Basic outlined example">';
 while($row1 = $query1->fetch(PDO::FETCH_OBJ)) {
   
   echo '<a class="btn btn-outline-primary text-decoration-none" href="/cages.php?id='.$row1->id.'" role="button">'.$row1->name.'</a>';
 }
 
 
 ?>
  </div>
  
  </div>

  <div class="card-container d-flex justify-content-evenly">
    <?php
      require 'configDB.php';
      
      $id = $_GET['id'];

    $sql = 'SELECT * FROM `cages` WHERE `typeid` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $text;
    $order;
    

    //   echo '<ul>';
      
      $sql5 = "SELECT * FROM `parrots` WHERE `typesid` = $id";
      $query5 = $pdo->prepare($sql5);
      $query5->execute([$id]);
      while($row = $query->fetch(PDO::FETCH_OBJ)) {


        if(($row->amount)>0){
          
          $order="/orders1.php";
        }
        else{
          // $text="Нет в наличии";
          $order="/notavailablecage.php";
        }
        
        

      echo '<div class="card d-flex justify-content-center" style="width: 18rem;">';
        
      
      
      $row5 = $query5->fetch(PDO::FETCH_OBJ);
        
       echo '<img src="data:image;base64,'.$row->img.'" class="card-img-top imgcage" alt="...">';
       echo  '<div class="card-body">';
       echo '<h5 class="card-title">Название : '.$row->name.'</h5>';
       
      echo '</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Вид попугая для клетки : '.$row->typmename.'</li>
        
        <li class="list-group-item">Цена : '.$row->price.' руб.</li>
        <li class="list-group-item">Наличие : '.$row->amount.' шт.</li>
        
      </ul>';

      $id1 = $_GET['id'];
      $sql1 = 'SELECT * FROM `cages` WHERE `typeid` = ?';
      $query1 = $pdo->prepare($sql1);
      $query1->execute([$id1]);
      $row1 = $query1->fetch(PDO::FETCH_OBJ);

      echo '<div class="card-body">
        
        <a href="/parrots.php?id='.$row1->typeid.'" class="card-link text-decoration-none m-0">Смотреть попугаев</a> <br>
        <a href="'.$order.'?id='.$row->id.'" class="card-link text-decoration-none m-0 disabled">Забронировать</a>
      </div>
    </div>';
    }
      


    ?>
    </div>

  </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>