<?php
  session_status() === PHP_SESSION_ACTIVE ?: session_start();

if(!$_SESSION['name']) {
    header('Location: index.php');
    exit();
}