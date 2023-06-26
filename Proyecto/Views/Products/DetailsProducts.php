<?php

require_once('../../Models/ClassProducts.php');

$objProduct = new Products();

$idProduct = $_GET['productId'];
$data = $objProduct->consultar_productos($idProduct);
echo $data;
