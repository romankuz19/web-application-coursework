<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Попугаи от Кеши</title>
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
    Мы являемся самым большим и удобным магазином попугаев. <br> Мы упорно работаем в данной сфере уже целых 5 лет и достигли вашего уважения и доверия. <br> У нас есть множество разнообразных видов попугаев на любой вкус. <br> Пожалуйста, выберите подходящий для вас вид.
  </h4>

  <div class="type-container d-flex justify-content-center">
  <?php
 
 require 'configDB.php';
 
 $query1 = $pdo->query('SELECT * FROM `types`');
 /* $row1 = $query1->fetch(PDO::FETCH_OBJ); */
 echo '<div class="btn-group pad" role="group" aria-label="Basic outlined example">';
 while($row1 = $query1->fetch(PDO::FETCH_OBJ)) {
   
   echo '<a class="btn btn-outline-primary text-decoration-none" href="/parrots.php?id='.$row1->id.'" role="button">'.$row1->name.'</a>';
 }
 
 // <button type="button" class="btn btn-outline-primary">Корелла</button>
 // <button type="button" class="btn btn-outline-primary">Жако</button>
 // <button type="button" class="btn btn-outline-primary">Ара</button>
 // <button type="button" class="btn btn-outline-primary">Кеа</button>
 ?>
  </div>
  
  
  </div>
    
    <!-- <form action="/add.php" method="post">
      <input type="text" name="task" id="task" placeholder="Нужно сделать.." class="form-control">
      <button type="submit" name="sendTask" class="btn btn-success">Отправить</button>
    </form> -->

    <!-- <?php
      require 'configDB.php';
      

      echo '<ul>';
      
      $query = $pdo->query('SELECT * FROM `parrots` ');
      while($row = $query->fetch(PDO::FETCH_OBJ)) {

        echo '<li><b>'.$row->name.'</b> <b>'.$row->typename.'</b> <b>'.$row->providername.'</b> <b>'.$row->info.'</b>';
        // echo '<li><b>'.$row->name.'</b> <b>'.$row->typename.'</b> <b>'.$row->providername.'</b> <b>'.$row->info.'</b><a href="/delete.php?id='.$row->id.'"><button>Удалить</button></a></li>';
      }
      echo '</ul>';

      
    ?> -->

<!-- <?php
$db = mysqli_connect("localhost","root","root","to-do"); 
$sql = "SELECT * FROM parrots";
$sth = $db->query($sql);
$result=mysqli_fetch_array($sth);
echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['img'] ).'"/>';
?> -->

  </div>
      

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
