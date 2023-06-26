<?php
require_once("../cls_adminnoticias.php");
$obj_Noticias = new cls_adminoticias();

if (isset($_POST["id"])) {
    $id = $_POST["id"];

  // Eliminar el producto de la base de datos
    $obj_Noticias->eliminar_noticias($id);

  // Llamar a la función para generar la tabla de productos actualizada
    generarTablaNoticias();
}

function generarTablaNoticias() {
    $obj_Noticias = new cls_adminoticias();
    $informacion = $obj_Noticias->consultar_noticias();
    echo $informacion;
}
?>
