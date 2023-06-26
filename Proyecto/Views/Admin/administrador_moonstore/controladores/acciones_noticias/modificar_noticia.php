<?php
require_once("controladores/cls_adminnoticias.php");
$obj_noticias = new cls_adminoticias();
$id = $_POST["id"];
$titulo = $_POST["titulo"];
$descripcion = $_POST["descripcion"];
    

    $obj_noticias->modificar_noticias($id, $titulo, $descripcion);

header("Location: admin_noticias");
exit();
?>