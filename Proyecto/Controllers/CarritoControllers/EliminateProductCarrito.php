<?php
require_once('../../Models/ClassCarrito.php');
$objCart = new Carrito();

$idCarrito = $_POST['IdCarrito'];
$objCart->RemoveProductForCart($idCarrito);
header('Location:/Proyecto/Views/Carrito/ViewCarritoUser.php');
