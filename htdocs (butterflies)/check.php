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


  <div class="container">

  <div class="inside-container">
  

  <div class="type-container d-flex justify-content-center">

  
      

      <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            
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
    echo '<h1 class="text-center">Некорректная длина логина, повторите попытку (не менее 3-х символов)</h1>';
    exit();
}
else if(mb_strlen($name)<2 || mb_strlen($name)>50){
    
    
    echo '<h1 class="text-center">Некорректная длина имени, повторите попытку (не менее 2-х символов)</h1>';
    exit();
}
else if(mb_strlen($pass)<2|| mb_strlen($pass)>15){
    echo '<h1 class="text-center">Некорректная длина пароля, повторите попытку (не менее 2-х символов)</h1>';
    exit();
}




    

    
$pass=md5($pass."passdp2545");

// $mysql=new mysqli('localhost','root','root','to-do');
$mysql->query("INSERT INTO `users`(`login`, `pass`, `name`) VALUES ('$login','$pass','$name')");
$mysql->close();

header('Location: /authorithation.php');

?>
