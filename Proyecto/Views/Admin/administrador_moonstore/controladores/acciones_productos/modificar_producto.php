<?php
require_once("controladores/cls_adminproductos.php");
$obj_productoss = new cls_adminproductos();

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$tallas = $_POST["tallas"];

// Color
if ($_POST["color"] === "otro") {
    $color = $_POST["otro-color"];
} else {
    $color = $_POST["color"];
}

$categoria = $_POST["categoria"];
$disponibilidad = $_POST["disponibilidad"];
$precio = $_POST["precio"];


//Crear carpeta para imagenes del producto
$nombreCarpetaProducto = $_POST["nombre"];
$nombreCarpeta = preg_replace('/[^A-Za-z0-9\-]/', '', trim($nombreCarpetaProducto));
$rutaCarpetaProducto = "imgProductos/$categoria/".$nombreCarpeta;
mkdir($rutaCarpetaProducto, 0777, true);

//Imagen principal
$imagenPrincipal = $_FILES["imagenPrincipal"]["name"];
$carpetaDestino = "imgProductos/$categoria/$nombreCarpeta/";
move_uploaded_file($_FILES["imagenPrincipal"]["tmp_name"], $carpetaDestino.$imagenPrincipal);
$enlaceImagenPrincipal = "administrador_moonstore/".$carpetaDestino.$imagenPrincipal;

//Album de imagenes
// Obtener el nombre de todas las imágenes enviadas en el álbum
$imagenesAlbum = $_FILES["albumImganes"]["name"];
$carpetaDestino = "imgProductos/$categoria/$nombreCarpeta/";
$enlacesImagenesAlbum = [];

// Iterar sobre cada imagen en el álbum
for ($i = 0; $i < count($imagenesAlbum); $i++) {
    $nombreImagen = $imagenesAlbum[$i];
    $rutaTemporal = $_FILES["albumImganes"]["tmp_name"][$i];

    // Mover la imagen a la carpeta de destino
    move_uploaded_file($rutaTemporal, $carpetaDestino.$nombreImagen);

    // Obtener el enlace de la imagen
    $enlaceImagen = $carpetaDestino.$nombreImagen;
    $enlacesImagenesAlbum[] = "administrador_moonstore/".$enlaceImagen;
}    

$obj_productos->modificar_producto($id, $nombre, $descripcion, $tallas, $color, $categoria, $disponibilidad, $precio, $enlaceImagenPrincipal, $enlacesImagenesAlbum);


header("Location: admin_productos");
exit();

?>