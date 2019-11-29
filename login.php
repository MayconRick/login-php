<?php
  session_status() === PHP_SESSION_ACTIVE ?: session_start();
  
include('db.php');

if (empty($_POST['cpf']) || empty($_POST['password'])) {
    header('Location: index.php');
    exit();
}

$cpf = mysqli_real_escape_string($connect, $_POST['cpf']);
$passord = mysqli_real_escape_string($connect, $_POST['password']);

$query = "SELECT name FROM user WHERE cpf = '{$cpf}' AND password = md5('{$passord}')";

$result = mysqli_query($connect, $query);

$row = mysqli_fetch_assoc($result);


if (!$row) {
    $_SESSION['not_autenticated'] = true;
    header('Location: index.php');
    exit();
}

$_SESSION['name'] = $row['name'];
header('Location: panel.php');
exit();