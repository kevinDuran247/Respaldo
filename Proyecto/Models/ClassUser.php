<?php
@session_start();
require_once('Connection.php');

class Users
{
    public function consultUsers()
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);

        return $result;
    }

    public function validateUser($email, $password, $password2)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $user = $row['nombre'];
            $email = $row['email'];
            $idUser = $row['id'];
            $typeUser = $row['tipo_usuario'];
            $foto = $row['perfil'];

            $_SESSION['user'] = $user;
            $_SESSION['email'] = $email;
            $_SESSION['typeUser'] = $typeUser;
            $_SESSION['idUser'] = $idUser;
            $_SESSION['perfil'] = $foto;
            $_SESSION['password'] = $password2;

            header('Location:../DashboardController.php');
        } else {
            $_SESSION['alert'] = "CORREO O CONTRASEÑA INCORRECTA";
            header('Location:../../Login.php');
        }
    }

    public function validateAdmin($email, $password)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE email = ? AND contraseña = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows == 1) {

            $row = $result->fetch_assoc();

            $user = $row['nombre'];
            $email = $row['email'];
            $idUser = $row['id'];
            $typeUser = $row['tipo_usuario'];
            $foto = $row['perfil'];

            $_SESSION['user'] = $user;
            $_SESSION['email'] = $email;
            $_SESSION['typeUser'] = $typeUser;
            $_SESSION['idUser'] = $idUser;
            $_SESSION['perfil'] = $foto;

            header('Location:/Proyecto/Controllers/DashboardController.php');
        } else {
            $_SESSION['alert'] = "CORREO O CONTRASEÑA INCORRECTA";
            header('Location:/Proyecto/mooadmin.php');
        }
    }


    public function imagenPerfil($id)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $row = $result->fetch_assoc();

        if ($row['perfil'] == "") {
            $foto = "User.png";
        } else {
            $foto = $row['perfil'];
        }

        $data = "";

        $data .= "
        <img src='/Proyecto/Imagenes/Fotos_de_perfil/$foto' alt='Foto de perfil' class='rounded-circle' width='38' height='38' style='object-fit: cover;'>
        ";
        return $data;
    }

    public function consultUser($id)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = "";
        $user = $_SESSION['user'];
        $email = $_SESSION['email'];

        $row = $result->fetch_assoc();


        if ($row['perfil'] == "") {
            $ruta = "/Proyecto/Imagenes/Fotos_de_perfil/User.png";
        } else {
            $ruta = "/Proyecto/Imagenes/Fotos_de_perfil/$row[perfil]";
        }

        $data .= "
                    <div class='col-sm-6'>
                        <div class='card'>
                            <img src='$ruta' alt='' srcset='' width='300px' height='300px' class='rounded-circle' style='margin:40px 0px 40px 40px; object-fit: cover; margin:20px auto 40px auto ;'>
                        </div>
                    </div>

                    <div class='col-sm-6'>  
                    
                                <h3 class='text-rigth text-uppercase'>$user</h3>
                                <h4 class='text-rigth'>$email</h4>
                            
                        <div class ='row'>
                                <div class='col-sm-3'>
                                    <p style='font-size:18px'>Contraseña:</p>
                                </div>
                                    <div class='col-sm-3'>
                                        <input type='password' class='form-control' id='passwordInput' style='border:none;' readonly value='$_SESSION[password]'>
                                    </div>
                                    <div class ='col-sm-2'>
                                        <button class='btn' type='button' id='toggleButton' onclick='togglePasswordVisibility()'>
                                            <i id='toggleIcon' class='fa-solid fa-eye'></i>
                                        </button> 
                                    </div>   
                        </div>

                            <div class='row'>
                                <div class='col-sm-3'>
                                        <p style='font-size:18px'>Direccion:</p>
                                </div>

                                <div class='col-sm-8'>
                                        <p style='font-size:18px'>$row[dirección]</p>
                                </div>
                            </div>

        
                            <div class='row'>
                                <div class='col-sm-3'>
                                <p style='font-size:18px'>Departamento:</p>
                                </div>
                                <div class='col-sm-9'>
                                    <p style='font-size:18px'>$row[departamento]</p>
                                </div>
                            </div>
                         

                        <div class='row'>
                            <div class='col-sm-3'>
                                <p style='font-size:18px'>Municipio:</p>
                                </div>
                                <div class='col-sm-9'>
                                <p style='font-size:18px'>$row[municipio]</p>
                            </div>
                        </div>


                            <div class='row'>
                                <div class='col-sm-10'>
                                    <a href='Edit_perfil.php' style ='font-family:Cascadia Mono'class ='btn btn-success'>Editar perfil</a>
                                </div>
                            </div>
                    </div>
                        ";

        return $data;
    }

    public function selectEditUser($id)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = "";

        $row = $result->fetch_assoc();

        $password = $_SESSION['password'];
        if ($row['perfil'] == "") {
            $ruta = "/Proyecto/Imagenes/Fotos_de_perfil/User.png";
        } else {
            $ruta = "/Proyecto/Imagenes/Fotos_de_perfil/$row[perfil]";
        }

        $data .= "

               <div class='col-sm-6 mx-auto mb-4'>
                    <div class='card' style='padding:20px'>
                        <img src='$ruta' alt='' srcset='' width='300px' height='300px' class='rounded-circle' style='margin:40px 0px 40px 40px; object-fit: cover; margin:20px auto 40px auto ;'>

                        <input type='file'  class='form-control mt-3' name='newPerfil'>

                        <div class='row mt-4'>
                            <div class='col-sm-6'>
                                <label class='form-label mt-2'>Nombre:</label>
                            </div>
                            <div class='col-sm-6'>
                                <input class='form-control' value='$row[nombre]' name='nombre'>
                            </div>
                        </div>

                        <div class='row mt-4'>
                            <div class='col-sm-6'>
                                <label class='form-label mt-2'>Email:</label>
                            </div>
                            <div class='col-sm-6'>
                                <input class='form-control' value='$row[email]' name='email'>
                            </div>
                        </div>

                        

                        <div class='row mt-4' id='selectContainer'>
                            <div class='col-sm-6'>
                                <label class='form-label mt-2'>Departamento:</label>
                            </div>

                            <div class='col-sm-6'>
                            <select id='departamento' class='form-select form-select' name='departamento' onchange='actualizarModelos()'>
                                <option value='' disabled>Selecciona un departamento</option>
                                <option value='San Salvador'>San Salvador</option>
                                <option value='La Libertad'>La Libertad</option>
                                <option value='Santa Ana'>Santa Ana</option>
                                <option value='Sonsonate'>Sonsonate</option>
                                <option value='La Paz'>La Paz</option>
                                <option value='San Miguel'>San Miguel</option>
                                <option value='Ahuachapán'>Ahuachapán</option>
                                <option value='La Unión'>La Unión</option>
                                <option value='Chalatenango'>Chalatenango</option>
                                <option value='Usulután'>Usulután</option>
                                <option value='Cuscatlán'>Cuscatlán</option>
                                <option value='Morazán'>Morazán</option>
                                <option value='Cabañas'>Cabañas</option>
                                <option value='San Vicente'>San Vicente</option>
                             </select>
                            </div>
                        </div>

                        <div class='row mt-4' id='modeloContainer'>
                            <div class='col-sm-6'>
                                <label class='form-label mt-2'>Municipio:</label>
                            </div>
                            <div class='col-sm-6'>
                                <select id='modelo' name='municipio' class='form-select form-select' >
                                    <option value='' disabled>Selecciona un municipio</option>
                                </select>
                            </div>
                        </div>

                        <div class='row mt-4'>
                            <div class='col-sm-6'>
                                <label class='form-label mt-2'>Dirección:</label>
                            </div>
                            <div class='col-sm-6'>
                                <input class='form-control' name='direccion' value='' placeholder='Ciudad, Canton, Pueblo, Casa...' id='direccion'>
                            </div>
                        </div>

                        <div class='row mx-auto m-4'>
                            <div class='col'>
                            <input class='btn btn-success' type='submit' value='Guardar'>
                            </div>
                        </div>
                    </div>
                </div>
                        ";

        return $data;
    }

    function crear_carpeta_usuario($nombre_usuario)
    {
        $ruta_carpeta = "Imagenes/Fotos_de_perfil/" . $nombre_usuario;
        if (!is_dir($ruta_carpeta)) {
            mkdir($ruta_carpeta, 0777, true);
            echo "Se ha creado la carpeta $ruta_carpeta para el usuario $nombre_usuario";
        } else {
            echo "La carpeta $ruta_carpeta ya existe para el usuario $nombre_usuario";
        }
    }

    function editUser($data)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $_SESSION['user'] = $data['nombre'];

        $sql = "UPDATE usuarios SET nombre=?, email=?, dirección=?,municipio=?, departamento=?, perfil=? WHERE id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $_SESSION['user'], $data['email'], $data['direccionUser'], $data['municipio'], $data['departamento'], $data['foto'], $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);
    }

    public function insertUser($data)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $data['email']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $_SESSION['alert'] = "ESE EMAIL YA EXISTE";
            header('Location:/Proyecto/Register.php');
        } else {
            $sql = "INSERT INTO usuarios (nombre, email, contraseña, dirección,municipio, departamento, fecha_registro, tipo_usuario ) VALUES (?,?,SHA1(?),?,?,?,?,?)";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "ssssssss", $data['nombre'], $data['email'], $data['password'], $data['direccion'], $data['municipio'], $data['departamento'], $data['fecha'], $data['tipo']);
            mysqli_stmt_execute($stmt);
        }
    }
}
