<?php
require_once("cn.php");

class cls_admincompras extends cn{

    public function filtrar_compras($email, $fecha){

        $sql = "";
            
        if ($email == "") {
            if ($fecha == "") {
                $sql = "SELECT c.id, c.id_transaccion, c.fecha, c.estado, c.email, c.id_cliente, c.total, c.id_usuario, 
                u.nombre AS nombre_usuario 
                FROM compras c JOIN usuarios u ON c.id_usuario = u.id;
                ";
            } else {
                // Solo $email está vacío, pero $fecha tiene un valor
                $sql = "SELECT c.id, c.id_transaccion, c.fecha, c.estado, c.email, c.id_cliente, c.total, c.id_usuario, 
                    u.nombre AS nombre_usuario 
                    FROM compras c JOIN usuarios u ON c.id_usuario = u.id WHERE DATE(c.fecha) = '$fecha'";
            }
        } else {
    
            $sql = "SELECT c.id, c.id_transaccion, c.fecha, c.estado, c.email, c.id_cliente, c.total, c.id_usuario, 
                u.nombre AS nombre_usuario 
                FROM compras c JOIN usuarios u ON c.id_usuario = u.id WHERE c.email LIKE '%$email%';";
        }
        
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[id_transaccion]</td>
                <td>$fila[fecha]</td>
                <td>$fila[estado]</td>
                <td>$fila[nombre_usuario]</td>
                <td>$fila[id_usuario]</td>
                <td>$fila[email]</td>
                <td>$fila[id_cliente]</td>
                <td>$$fila[total]</td>
                <td style='text-align: center;'>
                <a href='detalles_compras?id=$fila[id]' class='btn btn-small btn-warning'>Ver detalles</a>
                </td>
                </td>
            </tr>
            ";
        }
    
        return $info;
    }

    public function consultar_detalles($id){
        $sql = "SELECT * FROM detalles_compra WHERE id_compra = $id;
        ";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <tr>
                <td>$fila[nombre]</td>
                <td>$$fila[precio]</td>
                <td>$fila[cantidad]</td>
            </tr>
            ";
        }
    
        return $info;
    }

    public function consultar_totales($id){
        $sql = "SELECT SUM(cantidad) AS suma_cantidad, SUM(precio) AS suma_precio
        FROM detalles_compra
        WHERE id_compra = $id;
        ;
        ";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <tr>
                <td>Total: $fila[suma_cantidad]</td>
                <td>$$fila[suma_precio]</td>
            </tr>
            ";
        }
    
        return $info;
    }

    public function dinero_total(){
        $sql = "SELECT SUM(total) AS suma_total FROM compras;";

        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <h6>Dinero obtenido por ventas: <b>$$fila[suma_total]</b></h6>
            ";
        }
    
        return $info;
    }

    public function pdf_Compras(){
        $sql = "SELECT c.id, c.id_transaccion, c.fecha, c.estado, c.email, c.id_cliente, c.total, c.id_usuario, 
        u.nombre AS nombre_usuario 
        FROM compras c JOIN usuarios u ON c.id_usuario = u.id;
        ";
        $resultado = $this->cn()->query($sql);
        $info = "";
    
        while($fila = $resultado->fetch_assoc()){
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[id_transaccion]</td>
                <td>$fila[fecha]</td>
                <td>$fila[estado]</td>
                <td>$fila[nombre_usuario]</td>
                <td>$fila[id_usuario]</td>
                <td>$fila[email]</td>
                <td>$fila[id_cliente]</td>
                <td>$$fila[total]</td>
               
            </tr>
            ";
        }
    
        return $info;
    }
}
?>