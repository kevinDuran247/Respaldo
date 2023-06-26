<?php
require_once('../../Models/ClassUser.php');
$objUser = new Users();

$nombre = $_GET['nombreCompleto'];
$password = $_GET['passwordRegister'];
$email = $_GET['emailRegister'];
$departamento = $_GET['departamentoRegister'];
$municipio = $_GET['municipioRegister'];
$direccion = $_GET['direccionRegister'];
$fecha = $_GET['fechaRegister'];
$tipoUsuario = "Usuario";

$data = array(

    "nombre" => $nombre,
    "password" => $password,
    "email" => $email,
    "departamento" => $departamento,
    "municipio" => $municipio,
    "direccion" => $direccion,
    "fecha" => $fecha,
    "tipo" => $tipoUsuario
);


$objUser->insertUser($data);
header('Location:/Proyecto/Index.php');
