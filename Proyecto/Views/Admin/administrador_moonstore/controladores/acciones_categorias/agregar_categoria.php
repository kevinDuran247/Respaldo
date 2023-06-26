<?php
require_once("../cls_admincategorias.php");
$obj_Categorias = new cls_admincategorias();
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];

if (empty($nombre)) {
    echo "Nombre vacío";
} else {
    $obj_Categorias->insertar_categoria($_POST["nombre"], $_POST["descripcion"]);
}

generarTablaCategorias();

function generarTablaCategorias() {
    $obj_Categorias = new cls_admincategorias();
    $informacion = $obj_Categorias->consultar_categorias();
    echo $informacion;
}
?>
