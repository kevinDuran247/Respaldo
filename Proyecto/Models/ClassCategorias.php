<?php
require_once('Connection.php');
class Categorias
{
    public function consultar_selectCategorias()
    {
        $connection = new Connection();
        $connect = $connection->connect();
        $sql = "SELECT nombre FROM categorias";

        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $info = "";
        while ($fila = $result->fetch_assoc()) {
            $info .= "
                <option value='$fila[nombre]'>
                $fila[nombre]       
                </option>                  
            ";
        }
        return $info;
    }
}
