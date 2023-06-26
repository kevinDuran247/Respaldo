<?php

require_once('Connection.php');

class Noticias
{

    public function viewNotice()
    {

        $connection = new Connection;
        $connect = $connection->connect();

        $sql = "SELECT * FROM noticias";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = "";

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $data .= "
            <div class='row mt-4'>
        
                <div class='col-6 mt-4 noticias'>
                    <img src='/Proyecto/Views/Admin/$row[ruta_imagen]' alt='imagenNoticia' srcset=''>
                </div>
                <div class='col-6'>
                    <div class='row'>
                        <h3 class='text-center'>$row[titulo]</h3>
                    </div>
                    <div class='row'>
                        <p>$row[descripcion]</p>
                    </div>
                </div>
            </div>
                ";
            }
            return $data;
        } else {
            $data .= "
            <div class='row mt-4 text-center'>
                <h4>NO SE HA AGREGADO NINGUNA NOTICIA</h4>
            </div>
            ";
            return $data;
        }
    }
}
