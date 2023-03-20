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

<?php
          
          $id = $_GET['id'];
          if($id):
            
            $query1 = $pdo->query("SELECT * FROM `alivebutterfly` WHERE `id` = $id");
            
            $row1 = $query1->fetch(PDO::FETCH_OBJ);
            
            

              
              echo'  <div class="container">
               

<form class="form1" action="/sendorderbut.php" method="post">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label" >Логин заказчика</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="login" id="inputEmail3" placeholder="Введите логин" value="'.$row4->login.'" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label" >Имя заказчика</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" id="inputEmail3" placeholder="Введите имя" value="'.$row4->name.'" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label" >Вид бабочки</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="typename" id="inputPassword3" placeholder="Вид бабочки" value="'.$row1->typename.'" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label" >Цена за штуку (руб.) </label>
    <div class="col-sm-10">
      <input type="number" class="form-control" id="price"  placeholder="Цена за штуку (руб.)" value="'.$row1->price.'" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label" >Количество (доступно '.$row1->amount.' штуки</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="orderedamount" id="amount" oninput="myFunction()" placeholder="Введите количество, которое хотите заказать">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label" >Общая цена (руб.)</label>
    <div class="col-sm-10">
      <input type="number" class="form-control" name="totalprice" id="totalprice" placeholder="Общая цена (руб.)" readonly>
    </div>
  </div>
  
  
    <div class="col-sm-10 text-center">
      <button type="submit" class="btn btn-dark">Заказать!</button>
    </div>
  </div>
</form>

              </div>';


            
        ?>
        
        <?php else: ?>
          <a class="btn btn-dark" href="/orders.php">Заказы</a>
          <a class="btn btn-dark" href="/exit.php">Выход</a>
        
        <?php endif;?>



  
        <script>
                function myFunction(){
                   
      
                    var elem = document.getElementById("amount");
                    var value=elem.value;
                    var settype=document.getElementById("totalprice");
                    var elem2=document.getElementById("price");
                    var price=elem2.value;
                
                    settype.value=price*value;
                }
            </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
