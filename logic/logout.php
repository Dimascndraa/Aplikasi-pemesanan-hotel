<?php
session_start();
$_SESSION = [];
session_unset();
$_SESSION['login'] = 0;

setcookie('id', '', time() - 3600, '/');
setcookie('key', '', time() - 3600, '/');
setcookie('login', '', time() - 3600, '/');
header("location:../index.php?page=index&pesan=logout");
