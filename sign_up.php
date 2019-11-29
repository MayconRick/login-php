<?php 


session_start();
include('db.php');

function validateCPF($cpf) {
 
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    if (strlen($cpf) != 11) {
        return false;
    }
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true;
}


function validateEmail($email) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

if (!validateCPF($_POST['cpf'])) {
    $_SESSION['cpf_not_valid'] = true;
    header('Location: register.php');
    exit();
}

if (!validateEmail($_POST['email'])) {
    $_SESSION['email_not_valid'] = true;
    header('Location: register.php');
    exit();
}

$name = mysqli_real_escape_string($connect, trim($_POST['name']));
$password = mysqli_real_escape_string($connect, trim(md5($_POST['password'])));
$cpf = mysqli_real_escape_string($connect, trim($_POST['cpf']));
$email = mysqli_real_escape_string($connect, trim($_POST['email']));

$queryCPF = "SELECT count(*) as total from user where cpf = '$cpf' OR email = '$email'";


$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);


if ($row['total'] == 1) {
    $_SESSION['user_exists'] = true;
    header('Location: register.php');
    exit();
}

$query = "INSERT INTO user (name, cpf, email, password, created_at) VALUES ('$name','$cpf','$email','$password', now())";

if ($connect->query($query) === TRUE) {
    $_SESSION['status_register'] = true;
}

$connect->close();
header('Location: register.php');
exit();


?>