<?php
require_once("cn.php");

class cls_adminusuarios extends cn
{


    public function consultar_usuarios_por_departamento($departamento, $email)
    {
        $sql = "";

        if ($email == "") {
            $sql = "SELECT * FROM usuarios WHERE (departamento = '$departamento' OR '$departamento' = '') AND tipo_usuario = 'Usuario';";
        } else {
            $sql = "SELECT * FROM usuarios WHERE email LIKE '%$email%' AND tipo_usuario = 'Usuario';";
        }

        $resultado = $this->cn()->query($sql);
        $info = "";

        while ($fila = $resultado->fetch_assoc()) {
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[nombre]</td>
                <td>$fila[email]</td>
                <td>$fila[fecha_registro]</td>
                <td>$fila[dirección]</td>
                <td>$fila[municipio]</td>
                <td>$fila[departamento]</td>
                <td><img src='http://localhost/Proyecto/Imagenes/Fotos_de_perfil/$fila[perfil]' alt='Imagen de perfil' class='img-thumbnail img-fluid' style='width: 95px; height: auto;'></td>
            </tr>
            ";
        }

        return $info;
    }

    public function pdf_consultar()
    {
        $sql = "SELECT * FROM usuarios WHERE tipo_usuario = 'Usuario';";
        $resultado = $this->cn()->query($sql);
        $info = "";

        while ($fila = $resultado->fetch_assoc()) {
            $info .= "
            <tr>
                <th scope='row'>$fila[id]</th>
                <td>$fila[nombre]</td>
                <td>$fila[email]</td>
                <td>$fila[fecha_registro]</td>
                <td>$fila[dirección]</td>
                <td>$fila[municipio]</td>
                <td>$fila[departamento]</td>
                <td><img src='http://localhost/Proyecto/Imagenes/Fotos_de_perfil/$fila[perfil]' alt='Imagen de perfil' class='img-thumbnail img-fluid' style='width: 95px; height: auto;'></td>
            </tr>
            ";
        }

        return $info;
    }
}
