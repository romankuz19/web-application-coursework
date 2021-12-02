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
  <title>Ошибка</title>
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
$login = filter_var(trim($_POST['loginname']),FILTER_SANITIZE_STRING);
$username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
$phonenumber = filter_var(trim($_POST['phonenumber']),FILTER_SANITIZE_STRING);
$typename = filter_var(trim($_POST['typename']),FILTER_SANITIZE_STRING);
$id = filter_var(trim($_POST['idparrot']),FILTER_SANITIZE_STRING);


if(mb_strlen($phonenumber)!=10){


    echo '
    <div class="d-flex flex-column justify-content-center">
    <div>
    <h1 class="text-center">Некорректная длина номера телефона, повторите попытку (10 символов) <br></h1>
    </div>
    

    <div class="text-center">
    <a class="text-center text-decoration-none" style="font-size:40px" href="/notavailableparrot.php?id='.$id.'">Обратно к заполнению данных</a>
    </div>
    
    </div>
    ';
    
    exit();
}


$query2 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$login'");
$row2 = $query2->fetch(PDO::FETCH_OBJ);
$userid=$row2->id;




echo '<br>'.$login.'';
echo '<br>'.$username.'';
echo '<br>'.$phonenumber.'';
echo '<br>'.$typename.'';
echo '<br>'.$userid.'';




    // $mysql=new mysqli('localhost','root','root','to-do');
    $mysql->query("INSERT INTO `notification`(`userid`, `username`, `userlogin` , `userphone`, `namewishtype` , `iscompleted`) VALUES ('$userid','$username','$login' , '$phonenumber' , '$typename' , 0)");
    $mysql->close();



    header('Location: /ordersuccess.php');
?>
