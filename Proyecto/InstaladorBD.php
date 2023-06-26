<?php

if (isset($_POST['ok1'])) {
    $servidor = $_POST['servidor'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $base = $_POST['base'];

    $conexion = new mysqli($servidor, $usuario, $clave);

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Crear la base de datos
    $sqlCrearBD = "CREATE DATABASE IF NOT EXISTS $base";
    if ($conexion->query($sqlCrearBD) === true) {
        echo "Base de datos creada exitosamente<br>";
    } else {
        echo "Error al crear la base de datos: " . $conexion->error . "<br>";
    }

    // Seleccionar la base de datos
    $conexion->select_db($base);

    // Obtener el contenido del archivo SQL
    $sqlCrearTablaUsuarios = "CREATE TABLE usuarios (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        contraseña VARCHAR(255) NOT NULL,
        dirección VARCHAR(255) NOT NULL,
        municipio VARCHAR(100) NOT NULL,
        departamento VARCHAR(100) NOT NULL,
        fecha_registro DATETIME NOT NULL,
        perfil VARCHAR(255) NOT NULL,
        tipo_usuario VARCHAR (50),
        PRIMARY KEY (id)
        );";

    if ($conexion->query($sqlCrearTablaUsuarios) === true) {
        echo "Tabla usuarios creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla usuarios: " . $conexion->error . "<br>";
    }

    $sqlInsertUsuarios = "INSERT INTO usuarios (nombre, email, contraseña, dirección, municipio, departamento, fecha_registro, perfil, tipo_usuario)
    VALUES ('Kevin', 'kevin@gmail.com', SHA1('Kevin123*'), 'Santa Ana', 'Santa Ana', 'Santa Ana', NOW(), 'User.png', 'Administrador')";

    if ($conexion->query($sqlInsertUsuarios) === true) {
        echo "Datos insertados en la tabla usuarios correctamente<br>";
    } else {
        echo "Error al insertar datos en la tabla usuarios: " . $conexion->error . "<br>";
    }

    // Crear la tabla "categorias"
    $sqlCrearTablaCategorias = "CREATE TABLE categorias (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        descripcion VARCHAR(255) NOT NULL,
        PRIMARY KEY (id)
        );";
    if ($conexion->query($sqlCrearTablaCategorias) === true) {
        echo "Tabla categorias creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla categorias: " . $conexion->error . "<br>";
    }

    // Crear la tabla "productos"
    $sqlCrearTablaProductos = "CREATE TABLE productos (
        id INT NOT NULL AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        descripcion VARCHAR(255) NOT NULL,
        imagen_principal VARCHAR(255),
        precio DECIMAL(10,2) NOT NULL,
        color VARCHAR(20),
        disponibilidad INT NOT NULL,
        categoria_id INT,
        PRIMARY KEY (id),
        FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
        );";

    if ($conexion->query($sqlCrearTablaProductos) === true) {
        echo "Tabla productos creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla productos: " . $conexion->error . "<br>";
    }

    $sqlImagenes_productos = "CREATE TABLE imagenes_producto (
        id INT NOT NULL AUTO_INCREMENT,
        ruta VARCHAR(255) NOT NULL,
        producto_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
        );";

    if ($conexion->query($sqlImagenes_productos) === true) {
        echo "Tabla imagenes_productos creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla imagenes_productos: " . $conexion->error . "<br>";
    }

    $sqltallas_producto = "CREATE TABLE tallas_producto (
        id INT NOT NULL AUTO_INCREMENT,
        talla VARCHAR(20) NOT NULL,
        producto_id INT NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
        );";

    if ($conexion->query($sqltallas_producto) === true) {
        echo "Tabla tallas_productos creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla tallas_productos: " . $conexion->error . "<br>";
    }

    $sqlCarrito = "CREATE TABLE carrito (
        id INT NOT NULL AUTO_INCREMENT,
        usuario_id INT NOT NULL,
        producto_id INT NOT NULL,
        cantidad INT NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
        FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
        );";

    if ($conexion->query($sqlCarrito) === true) {
        echo "Tabla carrito creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla carrito: " . $conexion->error . "<br>";
    }


    $sqlCompras = "CREATE TABLE compras(
        id INT NOT NULL AUTO_INCREMENT,
        id_transaccion VARCHAR (50),
        fecha DATETIME,
        estado VARCHAR(20),
        email VARCHAR(100),
        id_cliente VARCHAR(100),
        total DECIMAL (10,2),
        id_usuario INT,
        PRIMARY KEY (id),
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        );";

    if ($conexion->query($sqlCompras) === true) {
        echo "Tabla compras creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla compras: " . $conexion->error . "<br>";
    }

    $sqlDetallesCompras = "CREATE TABLE detalles_compra(
        id INT NOT NULL AUTO_INCREMENT,
        id_compra INT,
        nombre VARCHAR(200),
        precio DECIMAL (10,2),
        cantidad INT,
        PRIMARY KEY (id),
        FOREIGN KEY (id_compra) REFERENCES compras(id)
        );";

    if ($conexion->query($sqlDetallesCompras) === true) {
        echo "Tabla detalle_compras creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla detalle_compras: " . $conexion->error . "<br>";
    }

    $sqlNoticias = "CREATE TABLE noticias (
        id INT NOT NULL AUTO_INCREMENT,
        ruta_imagen VARCHAR(255) NOT NULL,
        titulo VARCHAR (200) NOT NULL,
        descripcion TEXT NOT NULL,
        PRIMARY KEY (id)
        );";

    if ($conexion->query($sqlNoticias) === true) {
        echo "Tabla noticias creada exitosamente<br>";
    } else {
        echo "Error al crear la tabla noticias: " . $conexion->error . "<br>";
    }



    echo "Se terminó de crear las tablas";

    // Crear el archivo Config.php
    $contenidoConfig = "<?php" . PHP_EOL;
    $contenidoConfig .= 'define("HOST", "' . $servidor . '");' . PHP_EOL;
    $contenidoConfig .= 'define("USER", "' . $usuario . '");' . PHP_EOL;
    $contenidoConfig .= 'define("CLAVE", "' . $clave . '");' . PHP_EOL;
    $contenidoConfig .= 'define("DATABASE", "' . $base . '");' . PHP_EOL;
    $contenidoConfig .= "?>";

    // Escribir el contenido en el archivo Config.php
    $rutaConfig = "Models/Config.php";
    if (file_put_contents($rutaConfig, $contenidoConfig) !== false) {
        echo "Archivo Config.php creado exitosamente";
    } else {
        echo "Error al crear el archivo Config.php";
    }

    $contenidoConfig = "<?php" . PHP_EOL;
    $contenidoConfig .= 'define("HOST", "' . $servidor . '");' . PHP_EOL;
    $contenidoConfig .= 'define("USER", "' . $usuario . '");' . PHP_EOL;
    $contenidoConfig .= 'define("CLAVE", "' . $clave . '");' . PHP_EOL;
    $contenidoConfig .= 'define("DATABASE", "' . $base . '");' . PHP_EOL;
    $contenidoConfig .= "?>";

    // Escribir el contenido en el archivo Config.php
    $rutaConfig = "Views/Admin/administrador_moonstore/controladores/Config.php";
    if (file_put_contents($rutaConfig, $contenidoConfig) !== false) {
        echo "Archivo Config.php creado exitosamente";
    } else {
        echo "Error al crear el archivo Config.php";
    }

    // Cerrar la conexión
    $conexion->close();
    header('Location:/Proyecto/Index.php');
}

?>
<html>

<head>
    <title>
        Instador de la basde de datos del sistema de ventas
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js">
    </script>
</head>

<body>
    <div class="container col-sm-6 " style="margin-top: 30px;">
        <form method=post>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th colspan="2">
                            Información requerida para crear la basde de datos </th>
                    </tr>
                </thead>
                <tr>
                    <td> Ingrese la IP del servidor de base de datos </td>
                    <td>
                        <input type="text" name="servidor" id="">
                    </td>
                </tr>
                <tr>
                    <td>Ingrese el nombre del usuario</td>
                    <td> <input type="text" name="usuario" id=""> </td>
                </tr>
                <tr>
                    <td>Ingrese la clave del usuario</td>
                    <td> <input type="text" name="clave" id=""> </td>
                </tr>
                <tr>
                    <td>Ingrese el nombre de la base de datos</td>
                    <td> <input type="text" name="base" id=""> </td>
                </tr>
                <tr>
                    <td colspan=2 align=center>
                        <input type="submit" class="btn btn-dark" value="Crear base de datos" name="ok1">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>