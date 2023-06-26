<?php
require_once("../cls_adminproductos.php");
$adminProductos = new cls_adminproductos();

if (isset($_POST["id"])) {
  $id = $_POST["id"];

  // Eliminar el producto de la base de datos
  $adminProductos->eliminar_producto($id);

  // Llamar a la función para generar la tabla de productos actualizada
  generarTablaProductos();
}

function generarTablaProductos() {
  require_once("../cls_adminproductos.php");
  $adminProductos = new cls_adminproductos();
  $informacion = $adminProductos->consultar_productos();
  echo $informacion;
}
?>
