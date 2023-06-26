<?php
require_once("controladores/cls_admincategorias.php");
$obj_categorias = new cls_admincategorias();

    $id = $_GET['id'];
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];

    $obj_categorias->modificarCategoria($id, $nombre, $descripcion);

header("Location: admin_categorias");
exit();
?>