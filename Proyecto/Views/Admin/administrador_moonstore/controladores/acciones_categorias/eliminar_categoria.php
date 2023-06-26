<?php
require_once("../cls_admincategorias.php");
$obj_Categorias = new cls_admincategorias();

if (isset($_POST["id"])) {
    $id = $_POST["id"];

  // Eliminar el producto de la base de datos
    $obj_Categorias->eliminar_categoria($id);

  // Llamar a la función para generar la tabla de productos actualizada
    generarTablaCategorias();
}

function generarTablaCategorias() {
    $obj_Categorias = new cls_admincategorias();
    $informacion = $obj_Categorias->consultar_categorias();
    echo $informacion;
}
?>
