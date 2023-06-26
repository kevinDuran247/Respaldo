<?php

require('../../Models/ClassProducts.php');
$objProduct = new Products();

$Busqueda = $_POST['selectedCategory'];

$result = $objProduct->searchProductName($Busqueda);
echo $result;
