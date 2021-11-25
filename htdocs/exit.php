<?php
setcookie('user', $user['name'],time() - 3600, "/");
require 'configDB.php';

$query1 = $pdo->query("UPDATE `users` SET `online`= 0 WHERE `online` = 1");
header('Location: /');

?>