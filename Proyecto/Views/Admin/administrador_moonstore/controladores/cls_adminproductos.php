<?php
require_once("cn.php");

class cls_adminproductos extends cn{

    public function consultar_productos(){
        $sql = "
        SELECT productos.*, categorias.nombre AS nombre_categoria
        FROM productos
        LEFT JOIN categorias ON productos.categoria_id = categorias.id;        
        ";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $producto_id = $fila['id'];
    
            $sqlTallas = "SELECT talla FROM tallas_producto WHERE producto_id = '$producto_id';";
            $resultadoTallas = $this->cn()->query($sqlTallas);
            $tallas = "";
    
            while ($filaTallas = $resultadoTallas->fetch_assoc()) {
                $talla = $filaTallas['talla'];
                $tallas .= "$talla, ";
            }
    
            // Eliminar la coma y el espacio al final de las tallas
            $tallas = rtrim($tallas, ', ');

            $categoria = !empty($fila['nombre_categoria']) ? $fila['nombre_categoria'] : "Sin categoria";
            $info .= "
                <tr>
                    <th scope='row'>$fila[id]</th>
                    <td><img src='http://localhost/Proyecto/Views/Admin/$fila[imagen_principal]' alt='Imagen de categoría' class='img-thumbnail img-fluid' style='width: 95px; height: auto;'></td>
                    <td>$fila[nombre]</td>
                    <td>$$fila[precio]</td>
                    <td>$tallas</td>
                    <td>$fila[color]</td>
                    <td>$fila[disponibilidad]</td>
                    <td> $categoria</td>
                    <td style='text-align: center;'>
                    <a href='modificar_productos?id=$fila[id]&categoria=$categoria' class='btn btn-small btn-warning'><i class='fa-solid fa-pen-to-square'></i>Modificar</a>
                    <button class='btn btn-small btn-primary delete-button' data-id='$fila[id]'><i class='fa-solid fa-trash'></i>Eliminar</button>
                    </td>
                </tr>
            ";
        } 
        return $info;
    }

    public function consultar_pdf(){
        $sql = "
        SELECT productos.*, categorias.nombre AS nombre_categoria
        FROM productos
        LEFT JOIN categorias ON productos.categoria_id = categorias.id;        
        ";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $producto_id = $fila['id'];
    
            $sqlTallas = "SELECT talla FROM tallas_producto WHERE producto_id = '$producto_id';";
            $resultadoTallas = $this->cn()->query($sqlTallas);
            $tallas = "";
    
            while ($filaTallas = $resultadoTallas->fetch_assoc()) {
                $talla = $filaTallas['talla'];
                $tallas .= "$talla, ";
            }
    
            // Eliminar la coma y el espacio al final de las tallas
            $tallas = rtrim($tallas, ', ');

            $categoria = !empty($fila['nombre_categoria']) ? $fila['nombre_categoria'] : "Sin categoria";
            $info .= "
                <tr>
                    <th scope='row'>$fila[id]</th>
                    <td><img src='http://localhost/Proyecto/Views/Admin/$fila[imagen_principal]' alt='Imagen de categoría' class='img-thumbnail img-fluid' style='width: 95px; height: auto;'></td>
                    <td>$fila[nombre]</td>
                    <td>$$fila[precio]</td>
                    <td>$tallas</td>
                    <td>$fila[color]</td>
                    <td>$fila[disponibilidad]</td>
                    <td> $categoria</td>
                </tr>
            ";
        } 
        return $info;
    }

    public function insertar_producto($nombre, $descripcion, $tallas, $color, $categoria, $disponibilidad, $precio, $enlaceImagenPrincipal, $enlacesImagenesAlbum) {
        //Instancia para los $stmt
        $connet = new cn();
        $conn = $connet->cn();

        // Obtener id de la categoria
        $sqlIdCategoria = "SELECT id FROM categorias WHERE nombre = '$categoria' LIMIT 1;";
        $result = $this->cn()->query($sqlIdCategoria);
        $row = $result->fetch_assoc();
        $categoria_id = $row['id'];

        // Insertar producto en la tabla producto
        $sql = "INSERT INTO productos (nombre, descripcion, imagen_principal, precio, color, disponibilidad, categoria_id)
        VALUES (?, ?, ?, CAST(? AS DECIMAL(10,2)), ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $nombre, $descripcion, $enlaceImagenPrincipal, $precio, $color, $disponibilidad, $categoria_id);
        $resultado = mysqli_stmt_execute($stmt);
        
        // Obtener id del producto recien insertado
        $producto_id = mysqli_insert_id($conn);
    
        // Insertar tallas en la tabla tallas_producto
        $sqlTallas = "INSERT INTO tallas_producto (talla, producto_id) VALUES (?, ?)";
        $stmtTallas = mysqli_prepare($conn, $sqlTallas);
        foreach ($tallas as $talla) {
            mysqli_stmt_bind_param($stmtTallas, "si", $talla, $producto_id);
            mysqli_stmt_execute($stmtTallas);
        }

        // Insertar enlaces de imagenes en tabla imagenes_producto
        $sqlEnlacesImagenes = "INSERT INTO imagenes_producto (ruta, producto_id) VALUES (?, ?)";
        $stmtEnlacesImagenes = mysqli_prepare($conn, $sqlEnlacesImagenes);
        foreach ($enlacesImagenesAlbum as $enlaceImagen) {
            mysqli_stmt_bind_param($stmtEnlacesImagenes,"si", $enlaceImagen, $producto_id);
            mysqli_stmt_execute($stmtEnlacesImagenes);
        }

        if ($resultado) {
            echo "<br><span style=\"color:green;\">El producto <b>'$nombre'</b> ha sido insertado correctamente.</span>";

        } else {
            echo "<div class='alert alert-danger' role='alert'><b>El producto '$nombre' no pudo ser insertado, consulte al desarrollador<b></div>";
        }

    }

    public function modificar_producto($id, $nombre, $descripcion, $tallas, $color, $categoria, $disponibilidad, $precio, $enlaceImagenPrincipal, $enlacesImagenesAlbum) {
        //Instancia para los $stmt
        $connet = new cn();
        $conn = $connet->cn();

        // Obtener id de la categoria
        $sqlIdCategoria = "SELECT id FROM categorias WHERE nombre = '$categoria' LIMIT 1;";
        $result = $this->cn()->query($sqlIdCategoria);
        $row = $result->fetch_assoc();
        $categoria_id = $row['id'];

        // Insertar producto en la tabla producto
        $sql = "UPDATE productos 
                SET nombre = ?, 
                    descripcion = ?, 
                    imagen_principal = ?, 
                    precio = CAST(? AS DECIMAL(10,2)), 
                    color = ?, 
                    disponibilidad = ?, 
                    categoria_id = ?
                WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssii", $nombre, $descripcion, $enlaceImagenPrincipal, $precio, $color, $disponibilidad, $categoria_id, $id);
        mysqli_stmt_execute($stmt);

        
        // Obtener id del producto
        $producto_id = $id;
    
        // Actualizar tallas en la tabla tallas_producto
        $sqlTallas = "DELETE FROM tallas_producto 
            WHERE producto_id = ?";
        $stmtTallas = mysqli_prepare($conn, $sqlTallas);
        mysqli_stmt_bind_param($stmtTallas, "i", $producto_id);
        mysqli_stmt_execute($stmtTallas);

        $sqlTallass = "INSERT INTO tallas_producto (talla, producto_id) VALUES (?, ?)";
        $stmtTallass = mysqli_prepare($conn, $sqlTallass);
        foreach ($tallas as $talla) {
            mysqli_stmt_bind_param($stmtTallass, "si", $talla, $producto_id);
            mysqli_stmt_execute($stmtTallass);
        }

        // Actualizar enlaces de imagenes en tabla imagenes_producto
        $sqlEnlacesImageness = "DELETE FROM imagenes_producto 
                    WHERE producto_id = ?";
        $stmtEnlacesImageness = mysqli_prepare($conn, $sqlEnlacesImageness); 
        mysqli_stmt_bind_param($stmtEnlacesImageness, "i", $producto_id);
        mysqli_stmt_execute($stmtEnlacesImageness);

        $sqlEnlacesImagenes = "INSERT INTO imagenes_producto (ruta, producto_id) VALUES (?, ?)";
        $stmtEnlacesImagenes = mysqli_prepare($conn, $sqlEnlacesImagenes);
        foreach ($enlacesImagenesAlbum as $enlaceImagen) {
            mysqli_stmt_bind_param($stmtEnlacesImagenes,"si", $enlaceImagen, $producto_id);
            mysqli_stmt_execute($stmtEnlacesImagenes);
        }

    }

    public function eliminar_producto($id) {
        $con = $this->cn(); 
        if ($con) {
            $sql = "DELETE FROM productos WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function verificarProducto_existente($nombreProVerificacion){
        $sql = "
            SELECT nombre FROM productos WHERE nombre = '$nombreProVerificacion';
        ";
        $resultado = $this->cn()->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function consultar_datos_form($idProducto){
        $sql = "SELECT * FROM productos WHERE id = $idProducto";

        $resultado=$this->cn()->query($sql);
        $info="";
        while($fila=$resultado->fetch_assoc()){
            $info.= "   
                    <div class='mb-3'>
                        <label for='inputName' class='col-4 col-form-label'>ID:</label>
                            <input type='text' class='form-control' name='id' id='inputName'
                            value='$fila[id]' readonly>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label'>Nombre de producto:</label>
                        <input type='text' class='form-control' name='nombre' value='$fila[nombre]' required>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label'>Descripcion:</label>
                        <textarea class='form-control' name='descripcion' rows='4' cols='50'>$fila[descripcion]</textarea>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label'>Color:</label>
                        <select class='form-select' name='color' id='color-select' required>
                            <option value='$fila[color]'>$fila[color]</option>
                            <option value='Rojo'>Rojo</option>
                            <option value='Azul'>Azul</option>
                            <option value='Verde'>Verde</option>
                            <option value='Amarillo'>Amarillo</option>
                            <option value='Naranja'>Naranja</option>
                            <option value='Rosa'>Rosa</option>
                            <option value='Morado'>Morado</option>
                            <option value='Gris'>Gris</option>
                            <option value='Negro'>Negro</option>
                            <option value='Blanco'>Blanco</option>
                            <option value='Marrón'>Marrón</option>
                            <option value='Beige'>Beige</option>
                            <option value='Turquesa'>Turquesa</option>
                            <option value='Celeste'>Celeste</option>
                            <option value='Violeta'>Violeta</option>
                            <option value='otro'>Otro</option>
                        </select>
                    </div>
                    <div id='otro-color' class='mb-3 d-none'>
                        <label class='form-label'>Especificar otro color:</label>
                        <input type='text' name='otro-color' class='form-control'>
                    </div>


                    <div class='mb-3'>
                        <label class='form-label'>Disponibilidad:</label>
                        <input type='number' value='$fila[disponibilidad]' class='form-control' name='disponibilidad' pattern='^\d+(\.\d+)?$' placeholder='0'
                            required>
                    </div>

                    <div class='mb-3'>
                        <label class='form-label'>Precio:</label>
                        <input type='number' class='form-control' value='$fila[precio]' name='precio' step='0.01' min='0' placeholder='00.00' required>
                    </div>
            ";

        }
        return $info;
    }
}

//  BOTON AGREGAR PRODUCTO
$obj_productos = new cls_adminproductos();
if(isset($_POST["btnAgregarProducto"])){
    $nombreProVerificacion = $_POST["nombre"];

    if ($obj_productos->verificarProducto_existente($nombreProVerificacion)) {
        echo "<br><span style=\"color:red;\"><h5>El producto <b>'$nombreProVerificacion'</b> ya existe!</h5></span>";
    } else {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $tallas = $_POST["tallas"];
        //color
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
    
        $obj_productos->insertar_producto($nombre, $descripcion, $tallas, $color, $categoria, $disponibilidad, $precio, $enlaceImagenPrincipal, $enlacesImagenesAlbum);
    }   
}
