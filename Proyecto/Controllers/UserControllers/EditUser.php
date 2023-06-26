<?php
require_once('../../Models/ClassUser.php');
$objUser = new Users();

$data = $objUser->consultUsers();
$row = $data->fetch_assoc();


if (!empty($_POST['nombre']) && !empty($_POST['email'])  && !empty($_POST['departamento']) && !empty($_POST['municipio']) && !empty($_POST['direccion'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $direcDepartamento = $_POST['departamento'];
    $direcMunicipio = $_POST['municipio'];
    $direccion = $_POST['direccion'];
    $perfil = $_FILES['newPerfil'];
    if ($perfil['error'] == UPLOAD_ERR_NO_FILE) {
        $fotoPerfil = $row['perfil'];

        $direccionUser = $direcDepartamento . ", " . $direcMunicipio . ",  " . $direccion;
        $data  = array(
            "nombre" => $nombre,
            "email" => $email,
            "departamento" => $direcDepartamento,
            "municipio" => $direcMunicipio,
            "direccionUser" => $direccionUser,
            "foto" => $fotoPerfil
        );

        $objUser->editUser($data);
        header('Location:/Proyecto/Views/Users/Perfil_user.php');
    } else {
        if (isset($_FILES["newPerfil"])) {
            if (is_uploaded_file($_FILES['newPerfil']['tmp_name'])) {

                $tmp_name = $_FILES["newPerfil"]["tmp_name"];

                $nombrearchivo = "../../Imagenes/Fotos_de_perfil/" . $_FILES["newPerfil"]["name"];
                $fotoPerfil =  $_FILES["newPerfil"]["name"];


                if (is_file($nombrearchivo)) {
                    $idUnico = time();
                    $nombrearchivo = "../../Imagenes/Fotos_de_perfil/" . $idUnico . "-" . $_FILES["newPerfil"]["name"];
                    $fotoPerfil =  $_FILES["newPerfil"]["name"];
                }

                move_uploaded_file($tmp_name, $nombrearchivo);
                $direccionUser = $direcDepartamento . ", " . $direcMunicipio . ",  " . $direccion;
                $data  = array(
                    "nombre" => $nombre,
                    "email" => $email,
                    "departamento" => $direcDepartamento,
                    "municipio" => $direcMunicipio,
                    "direccionUser" => $direccionUser,
                    "foto" => $fotoPerfil
                );

                $objUser->editUser($data);
                header('Location:/Proyecto/Views/Users/Perfil_user.php');

                print("Fichero subido con exito");
            } else {
                echo "No se ha podido subir el fichero\n";
            }
        }
    }
} else {
    $_SESSION['alert'] = "RELLENE LOS CAMPOS VACIOS";
    header('Location:/Proyecto/Views/Users/Edit_perfil.php');
}
