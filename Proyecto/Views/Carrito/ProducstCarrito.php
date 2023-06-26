<?php

require_once('../../Models/ClassCarrito.php');
$objCarrito = new Carrito();

$data = $objCarrito->consultQuantyCarritoUser();
echo $data;
