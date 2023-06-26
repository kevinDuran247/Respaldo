<?php
require_once("cn.php");

class cls_admincategorias extends cn{

    public function consultar_categorias(){
        $sql="SELECT * FROM categorias";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $descripcion = !empty($fila['descripcion']) ? $fila['descripcion'] : "Sin descripcion";
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[nombre]</td>
                <td>$descripcion</td>
                <td style='text-align: center;'>
                <a href='modificar_categorias?id=$fila[id]' class='btn btn-small btn-warning'>MODIFICAR</a>
                <button class='btn btn-small btn-primary delete-category-button' data-id='$fila[id]'>Eliminar</button>
                </td>
            </tr>
            ";
        }
        
        return $info;
    }

    public function reportePdf(){
        $sql="SELECT * FROM categorias";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $descripcion = !empty($fila['descripcion']) ? $fila['descripcion'] : "Sin descripcion";
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[nombre]</td>
                <td>$descripcion</td>
            </tr>
            ";
        }
        
        return $info;
    }

    public function insertar_categoria($nombre, $descripcion){
        $connet = new cn();
        $conn = $connet->cn();

        $sql = "INSERT INTO categorias (nombre,  descripcion )
                VALUES (?, ?);
            ";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $nombre, $descripcion);
        mysqli_stmt_execute($stmt);

    }

    public function eliminar_categoria($id) {
        $con = $this->cn(); 
        if ($con) {
            $sql = "DELETE FROM categorias WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function consultar_selectCategorias (){
        $sql = "SELECT nombre FROM categorias";

        $resultado=$this->cn()->query($sql);
        $info="";
        while($fila=$resultado->fetch_assoc()){
            $info.= "
                <option value='$fila[nombre]'>
                $fila[nombre]       
                </option>                  
            ";

        }
        return $info;
    }

    public function consultar_datos_form ($idCategoria){
        $sql = "SELECT * FROM categorias WHERE id = $idCategoria";

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
                            <label class='form-label'>Nombre de la categoría:</label>
                            <input type='text' class='form-control' name='nombre' value='$fila[nombre]' required>
                        </div>
                        <div class='mb-3'>
                            <label class='form-label'>Descripción:</label>
                            <textarea class='form-control' name='descripcion' rows='4' cols='50' placeholder='Opcional..'>$fila[descripcion]</textarea>
                        </div>
                        <div class='text-end'>
                            <input type='submit' value='Modificar categoria' class='btn btn-warning'>
                        </div>
            ";

        }
        return $info;
    }

    public function modificarCategoria($id, $nombre, $descripcion){
        $sql="
        UPDATE categorias SET nombre = '$nombre', descripcion = '$descripcion' WHERE id = $id;
        ";
        $resultado=$this->cn()->query($sql);
    }

    public function consultar_selectNot($categoriaNot){
        $sql= "
        SELECT nombre FROM categorias WHERE nombre != '$categoriaNot';
        ";
        $resultado=$this->cn()->query($sql);
        $info="";
        while($fila=$resultado->fetch_assoc()){
            $info.= "
                <option value='$fila[nombre]'>
                $fila[nombre]       
                </option>                  
            ";

        }
        return $info;
    }
}
