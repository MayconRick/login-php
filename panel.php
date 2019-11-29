<?php
  session_status() === PHP_SESSION_ACTIVE ?: session_start();
include('verify_login.php');

?>

<h2>Olá, <?php echo $_SESSION['name']; ?></h2>
<h2> <a href="logout.php">Sair</a> </h2>