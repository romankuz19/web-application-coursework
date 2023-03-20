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
  <title>Добавление</title>
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
  

  <div class="type-container d-flex justify-content-around">
      <div class="container2">
      <div class="dropdown">
      <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Выберите вид бабочки
      </a>
      <?php
             require 'configDB.php';
             $query = $pdo->query("SELECT * FROM `types`");
               
             echo '<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
             $counttypes=1;
             while($row = $query->fetch(PDO::FETCH_OBJ)){
                
              
            echo '<li><a class="dropdown-item" style="cursor:pointer" id="linktype'.$counttypes.'" onclick="setType('.$counttypes.')">'.$row->originalname.'</a></li>';
            $counttypes++;
             }
             echo '</ul>';
             echo '';
        ?>    
    </div>
    <br>
    <br>
    
      </div>
  

      <?php
          require 'configDB.php';
          $query4 = $pdo->query("SELECT * FROM `users` WHERE `login` = '$currentuser'");
          $row4 = $query4->fetch(PDO::FETCH_OBJ);
           
          if($row4->admin == 1):
        ?>
            <form class=" form1 w-50" action="/add.php" method="post" enctype="multipart/form-data">

        
            


<input type="text" class="form-control" name="typename" id="typename" placeholder="Введите вид бабочки"> <br>

<input type="number" class="form-control" name="butprice" placeholder="Введите цену бабочки"> <br>

<input type="number" class="form-control" name="butamount" placeholder="Введите количество бабочек"> <br>

<input type="text" class="form-control" name="shortdiscr" placeholder="Введите среду обитания бабочки"> <br>

<input type="number" class="form-control" name="size" placeholder="Введите размер бабочки"> <br>

<input type="number" class="form-control" name="lifetime" placeholder="Введите продолжительность жизни"> <br>

<p class="m-0">Выберите картинку</p> <br>

<input type="file" name="myfile" value=""/> <br> <br>

<div class="d-flex justify-content-center">
<button class="btn btn-warning" type="submit" name="upload">Добавить бабочку</button> <br>
</div>



</div>

</form>
            <?php endif;?>
  
  
 
  </div>
  
  
  </div>
    
   



  </div>
      

  </div>



  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function setType(id){

      var some="linktype"+id;
      
      var elem = document.getElementById(some);
      var value=elem.innerHTML;
      var settype=document.getElementById("typename");
  
      settype.value=value;
    }
    function setProvider(id){

    var some="linkprovider"+id;

    var elem = document.getElementById(some);
    var value=elem.innerHTML;
    var settype=document.getElementById("providername");

    settype.value=value;
    }

  </script>         
</body>
</html>
