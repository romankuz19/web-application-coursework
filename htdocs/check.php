<?php
$mysql=new mysqli('localhost','root','root','dbparrots');

if($mysql){

}
else
die(' База данных не найдена или отсутствует доступ.');
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Доабвить поставщика</title>
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
          $currentuser=$_SESSION['name'];
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
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
  

  <div class="type-container d-flex justify-content-center">

  
      

      <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <form class="form1 w-75" action="/addprov.php" method="post" enctype="multipart/form-data">

        
            
<input type="text" class="form-control" name="providername" id="providername" placeholder="Введите наименование поставщика"> <br>

<input type="text" class="form-control" name="providerinfo" placeholder="Введите информацию о поставщике"> <br>

<input type="text" class="form-control" name="providerhistory" placeholder="Введите историю поставщика"> <br>

<div class="d-flex justify-content-center">
<button class="btn btn-primary" type="submit" name="upload">Добавить поставщика</button> <br>
</div>



</div>

</form>
            <?php endif;?>
  
  
 
  </div>
  
  
  </div>
    
   



  </div>
      

  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
 require 'configDB.php';
 


$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);


preg_match("/[\d]+/", $name,$match);


if(is_numeric($match[0])){
    echo '<h1 class="text-center">В имени содержатся цифры, некорректное имя</h1>';
    exit();
}





$query = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
while($row = $query->fetch(PDO::FETCH_OBJ)){
  
    echo '<h1 class="text-center">Пользователь с таким логином уже существует</h1>';
      exit();
  
}


if(mb_strlen($login)<3 || mb_strlen($login)>90){
    echo '<h1 class="text-center">Некорректная длина логина, повторите попытку (не менее 3-ех символов)</h1>';
    exit();
}
else if(mb_strlen($name)<2 || mb_strlen($name)>50){
    
    
    echo '<h1 class="text-center">Некорректная длина имени, повторите попытку (не менее 2-ух символов)</h1>';
    exit();
}
else if(mb_strlen($pass)<2|| mb_strlen($pass)>15){
    echo '<h1 class="text-center">Некорректная длина пароля, повторите попытку (не менее 2-ух символов)</h1>';
    exit();
}




    

    
$pass=md5($pass."passdp2545");

// $mysql=new mysqli('localhost','root','root','to-do');
$mysql->query("INSERT INTO `users`(`login`, `pass`, `name`) VALUES ('$login','$pass','$name')");
$mysql->close();

header('Location: /authorithation.php');

?>
