<?php
session_start();
require_once('../../Models/ClassCarrito.php');
$objCarrito = new Carrito();

if (!isset($_SESSION['user'])) {
} else {
    $usuario = $_SESSION['idUser'];
    $producto = $_POST['idProduct'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $subtotal = $cantidad * $precio;

    $data = array(
        "usuario" => $usuario,
        "producto" => $producto,
        "cantidad" => $cantidad,
        "subtotal" => $subtotal
    );
    $objCarrito->insertProductForCarrito($data);

    $data = $objCarrito->consultQuantyCarritoUser();
    echo $data;
}
