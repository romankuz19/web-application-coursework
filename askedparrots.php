<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Уведомить</title>
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
 <h1>Если вы уведомили пользователя, о наличии попугая, то завершите данное уведомление</h1>
  <div class="inside-container">
  

  <?php
  require 'configDB.php';
  $id = $_GET['id'];

$sql = 'SELECT * FROM `parrots` WHERE `id` = ?';
$query = $pdo->prepare($sql);
$query->execute([$id]);
$row = $query->fetch(PDO::FETCH_OBJ);
$typeid=$row->typesid;
$typename=$row->typename;
$query1 = $pdo->prepare($sql);
$query1->execute([$id]);
 $row1 = $query1->fetch(PDO::FETCH_OBJ);
  $query4 = $pdo->query("SELECT * FROM `users` WHERE `online` = 1");
 
 $row4 = $query4->fetch(PDO::FETCH_OBJ);

 $query10 = $pdo->query("SELECT * FROM `notification` WHERE `iscompleted` = 0");
  while($row10=$query10->fetch(PDO::FETCH_OBJ)) {
  echo '<form class="form1 d-flex flex-column justify-content-center" action="/closenotification.php" method="post">
  <h6 class="text-center">Контактные данные запросчика</h6>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Имя</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" value="'.$row10->username.'" readonly>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail2" class="form-label">Логин</label>
    <input type="text" class="form-control" name="loginname" id="exampleInputEmail2" aria-describedby="emailHelp" value="'.$row10->userlogin.'" readonly>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail2" class="form-label">Вид попугая, который запрашивается</label>
    <input type="text" class="form-control" name="typename" id="exampleInputEmail2" aria-describedby="emailHelp" value="'.$row10->namewishtype.'" readonly>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail3" class="form-label">Контактный номер телефона</label>
    <input type="text" class="form-control" name="phonenumber" id="exampleInputEmail3" value="'.$row10->userphone.'" aria-describedby="emailHelp" readonly>
    
  </div>

  
  <button type="submit" class="btn btn-primary">Завершить</button>
</form>';
  }
?>

      
  <div class="type-container d-flex justify-content-center">
 
  </div>
  
  
  </div>
    

  </div>
      




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
