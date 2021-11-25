<?php
require 'configDB.php';
$image = addslashes($_FILES['myfile']['tmp_name']);
$name  = addslashes($_FILES['myfile']['tmp_name']);
$image = file_get_contents($image);
$image = base64_encode($image);


$stmt=$pdo->prepare("UPDATE `cages` SET `img` = '$image' WHERE `id`= 6");
$stmt->execute();
?>