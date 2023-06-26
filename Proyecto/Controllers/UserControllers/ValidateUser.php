<?php
require_once('../../Models/ClassUser.php');
$objUser = new Users();


if (!empty($_GET['email']) && !empty($_GET['password'])) {
    $email = $_GET['email'];
    $password = $_GET['password'];
    $PasswordEncriptada = sha1($password);

    $objUser->validateUser($email, $PasswordEncriptada, $password);
}
