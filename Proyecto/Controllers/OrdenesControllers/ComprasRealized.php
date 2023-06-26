<?php
require_once('../../Models/ClassCompra.php');
$objCompra = new Compras();

$idCompra = $_GET['IDCompra'];

$data = $objCompra->consultDetailsCompras($idCompra);
echo $data;
