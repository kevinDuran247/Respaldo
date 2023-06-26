<?php
require_once("cn.php");

class cls_adminoticias extends cn{

    public function consultar_noticias(){
        $sql = "SELECT * FROM noticias";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td><img src='http://localhost/Proyecto/Views/Admin/$fila[ruta_imagen]' alt='Imagen de perfil' class='img-thumbnail img-fluid' style='width: 95px; height: auto;'></td>
                <td>$fila[titulo]</td>
                <td>$fila[descripcion]</td>
                <td style='text-align: center;'>
                <a href='modificar_noticias?id=$fila[id]' class='btn btn-small btn-warning'>Modificar</a>
                <button class='btn btn-small btn-primary delete-noticia-button' data-id='$fila[id]'>Eliminar</button>
                </td>
            </tr>
            ";
        }
    
        return $info;
    }

    public function agregar_noticias($ruta_imagen, $titulo, $descripcion){
        $connet = new cn();
        $conn = $connet->cn();

        $sql = "INSERT INTO noticias (ruta_imagen, titulo, descripcion)
        VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $ruta_imagen, $titulo, $descripcion);
        mysqli_stmt_execute($stmt);
    }

    public function eliminar_noticias($id){
        $con = $this->cn(); 
        if ($con) {
            $sql = "DELETE FROM noticias WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function consultar_datos_form ($id){
        $sql = "SELECT * FROM noticias WHERE id = $id";

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
                <label class='form-label'>Titulo</label>
                <input type='text' class='form-control' value='$fila[titulo]' name='titulo' placeholder='Titulo' required>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Descripcion</label>
                <textarea class='form-control' name='descripcion'  rows='4' cols='50' placeholder='Detalles de la noticia'
                    required>$fila[descripcion]</textarea>
            </div>
            <div class='text-end'>
                <button type='submit' class='btn btn-warning'>EDITAR</button>
            </div>
            ";

        }
        return $info;
    }
    public function modificar_noticias($id, $titulo, $descripcion){
        $sql="
            UPDATE noticias SET titulo = '$titulo', descripcion = '$descripcion' WHERE id = $id;
        ";
        $resultado=$this->cn()->query($sql);
    }

}
$obj_noticias = new cls_adminoticias();
if(isset($_POST["btnAgregarNoticia"])){
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];

    $imagen = $_FILES["imagen"]["name"];
    $carpetaDestino = "imgNoticias/";
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpetaDestino.$imagen);
    $enlaceImagen = "administrador_moonstore/".$carpetaDestino.$imagen;

    $obj_noticias->agregar_noticias($enlaceImagen, $titulo, $descripcion);

}
?>