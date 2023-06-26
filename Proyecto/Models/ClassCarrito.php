<?php
require_once('Connection.php');

class Carrito
{
    public function consultQuantyCarritoUser()
    {

        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT SUM(subtotal) AS total_subtotal, SUM(cantidad) AS cantidad FROM carrito WHERE usuario_id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $row = $result->fetch_assoc();

        $count = $row['cantidad'];


        $resultado = $count;
        return $resultado;
    }

    public function insertProductForCarrito($data)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sqlProductos = "SELECT * FROM productos WHERE id = ?";
        $stmtProductos = mysqli_prepare($connect, $sqlProductos);
        mysqli_stmt_bind_param($stmtProductos, "i", $data['producto']);
        mysqli_stmt_execute($stmtProductos);

        $result = mysqli_stmt_get_result($stmtProductos);
        $rowProductos = $result->fetch_assoc();

        $sql = "SELECT SUM(subtotal) AS total_subtotal, SUM(cantidad) AS cantidad FROM carrito WHERE usuario_id=? AND producto_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['idUser'], $data['producto']);
        mysqli_stmt_execute($stmt);

        $resultCarrito = mysqli_stmt_get_result($stmt);

        $rowCarrito = $resultCarrito->fetch_assoc();

        $cantidadTotal = $data['cantidad'] + $rowCarrito['cantidad'];

        if ($cantidadTotal > $rowProductos['disponibilidad']) {
            $_SESSION['alert'] = "CANTIDAD EXCEDIDA A LA DISPONIBLE";

            echo "
            <script>
            var url = '/Proyecto/Index.php';
                window.location.href = url;
            </script>

            ";
        } else {
            //Verificar si los datos ya existen en la base de datos
            $sql_select = "SELECT id, cantidad, subtotal FROM carrito WHERE usuario_id = ? AND producto_id = ?";
            $stmt_select = mysqli_prepare($connect, $sql_select);
            mysqli_stmt_bind_param($stmt_select, "ii", $data['usuario'], $data['producto']);
            mysqli_stmt_execute($stmt_select);
            $result = mysqli_stmt_get_result($stmt_select);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $newSubtotal = $data['subtotal'] + $row['subtotal'];
                $newCantidad = $row['cantidad'] + $data['cantidad'];
                $sql_update = "UPDATE carrito SET cantidad = ?, subtotal=? WHERE usuario_id = ? AND producto_id = ?";
                $stmt_update = mysqli_prepare($connect, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "idii", $newCantidad, $newSubtotal, $data['usuario'], $data['producto']);
                mysqli_stmt_execute($stmt_update);
            } else {
                // Los datos no existen, realizar la inserción
                $row = $result->fetch_assoc();

                $newSubtotal = $data['subtotal'] + (!empty($row['subtotal']) ? $row['subtotal'] : 0);
                $sql_insert = "INSERT INTO carrito(usuario_id, producto_id, cantidad, subtotal) VALUES (?,?,?,?)";
                $stmt_insert = mysqli_prepare($connect, $sql_insert);
                mysqli_stmt_bind_param($stmt_insert, "iiid", $data['usuario'], $data['producto'], $data['cantidad'], $newSubtotal);
                mysqli_stmt_execute($stmt_insert);
            }
        }
    }

    public function insertProductForCarritoIndex($data)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sqlProductos = "SELECT * FROM productos WHERE id = ?";
        $stmtProductos = mysqli_prepare($connect, $sqlProductos);
        mysqli_stmt_bind_param($stmtProductos, "i", $data['producto']);
        mysqli_stmt_execute($stmtProductos);

        $result = mysqli_stmt_get_result($stmtProductos);
        $rowProductos = $result->fetch_assoc();

        $sql = "SELECT SUM(subtotal) AS total_subtotal, SUM(cantidad) AS cantidad FROM carrito WHERE usuario_id=? AND producto_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $_SESSION['idUser'], $data['producto']);
        mysqli_stmt_execute($stmt);

        $resultCarrito = mysqli_stmt_get_result($stmt);

        $rowCarrito = $resultCarrito->fetch_assoc();

        if ($rowCarrito['cantidad'] >= $rowProductos['disponibilidad']) {
            $_SESSION['alert'] = "CANTIDAD EXCEDIDA A LA DISPONIBLE";

            echo "
            <script>
            var url = '/Proyecto/Index.php';
                window.location.href = url;
            </script>

            ";
        } else {
            //Verificar si los datos ya existen en la base de datos
            $sql_select = "SELECT id, cantidad, subtotal FROM carrito WHERE usuario_id = ? AND producto_id = ?";
            $stmt_select = mysqli_prepare($connect, $sql_select);
            mysqli_stmt_bind_param($stmt_select, "ii", $data['usuario'], $data['producto']);
            mysqli_stmt_execute($stmt_select);
            $result = mysqli_stmt_get_result($stmt_select);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $newSubtotal = $data['subtotal'] + $row['subtotal'];
                $newCantidad = $row['cantidad'] + $data['cantidad'];
                $sql_update = "UPDATE carrito SET cantidad = ?, subtotal=? WHERE usuario_id = ? AND producto_id = ?";
                $stmt_update = mysqli_prepare($connect, $sql_update);
                mysqli_stmt_bind_param($stmt_update, "idii", $newCantidad, $newSubtotal, $data['usuario'], $data['producto']);
                mysqli_stmt_execute($stmt_update);
            } else {
                // Los datos no existen, realizar la inserción
                $row = $result->fetch_assoc();
                $newSubtotal = $data['subtotal'] + $row['subtotal'];
                $sql_insert = "INSERT INTO carrito(usuario_id, producto_id, cantidad, subtotal) VALUES (?,?,?,?)";
                $stmt_insert = mysqli_prepare($connect, $sql_insert);
                mysqli_stmt_bind_param($stmt_insert, "iiid", $data['usuario'], $data['producto'], $data['cantidad'], $newSubtotal);
                mysqli_stmt_execute($stmt_insert);
            }
        }
    }

    public function consultCarritoUser()
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT c.id AS idCarrito, p.imagen_principal AS imagen_principal, p.nombre AS nombre, p.precio AS precio, c.cantidad  AS cantidad, c.producto_id AS idProduct, c.subtotal AS subtotal FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $sqlTotal = "SELECT SUM(subtotal) AS total FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = ?";
        $stmtTotal = mysqli_prepare($connect, $sqlTotal);
        mysqli_stmt_bind_param($stmtTotal, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmtTotal);
        $resulTotal = mysqli_stmt_get_result($stmtTotal);
        $rowTotal = $resulTotal->fetch_assoc();

        $data = "";
        if ($result->num_rows > 0) {


            while ($row = $result->fetch_assoc()) {
                $data .= "
         
                <tr style='border-bottom:none'>
                        <input type='hidden' value='$row[idCarrito]' name='IdCarrito'>
                        <td><button type='submit' class='button'>X</button></td>
                        <td><img src='http://localhost/Proyecto/Views/Admin/$row[imagen_principal]' class='img-thumbnail' style='width:100px; height:100px;border:none; margin:auto; border-radius:25px;object-fit: cover;'></td>
                        <td>$row[nombre]</td>
                        <td>$$row[precio]</td>
                        <input type='hidden' value='$row[idProduct]' id='IdProductCarrito'>
                        <td>
                            $row[cantidad]
                        </td>";
                $subtotal = $row['cantidad'] * $row['precio'];
                $data .= "    <td  style=' border-right: none;'>
                                    $$subtotal.00
                        </td>
                 </tr>
             
                ";
            };
            $data .= "
            <tr>
                <td  colspan='6' style='border-right:none'>
                <strong> TOTAL: </strong> $$rowTotal[total]
                </td>
            </tr>
            
            ";
            return $data;
        } else {
            $data .= "
        <tr id='btnPagar'>
            <td colspan='6' style='border-bottom:none; border-right:none; border-top:1px solid #000'>
                 <h4>NO HAS AGREGADO NINGUN PRODUCTO A TU CARRRITO</h4>
            </td> 
         </tr>
            ";
            return $data;
        }
    }

    public function PagarCarrito()
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT c.id AS idCarrito, p.imagen_principal AS imagen_principal, p.nombre AS nombre, p.precio AS precio, c.cantidad  AS cantidad, c.producto_id AS idProduct, c.subtotal AS subtotal FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $sqlTotal = "SELECT SUM(subtotal) AS total FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = ?";
        $stmtTotal = mysqli_prepare($connect, $sqlTotal);
        mysqli_stmt_bind_param($stmtTotal, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmtTotal);
        $resulTotal = mysqli_stmt_get_result($stmtTotal);
        $rowTotal = $resulTotal->fetch_assoc();

        $data = "";
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $data .= "
                <input type='hidden' value='$row[idCarrito]' name='idCarrito[]'> 
                <input type='hidden' value='$row[nombre]' name='Producto[]'>
                <input type='hidden' value='$row[precio]' name='Precio[]'>
                <input type='hidden' value='$row[cantidad]' name='Cantidad[]'>
                <input type='hidden' value='$row[subtotal]' name='Subtotal[]'>
                <input type='hidden' value='$rowTotal[total]' name='total'>
                <input type='hidden' value='$row[idProduct]' name='idProduct[]'>
                ";
            }
            $data .= " <button href='/Proyecto/Views/Ordenes/Pago.php' type='submit' class='btn btn-success'>Pagar</button>";
            return $data;
        }
    }




    public function updateCartUser($cantidad, $idProducto)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM carrito WHERE usuario_id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = $result->fetch_assoc();

        $sqlProduct = "SELECT * FROM productos WHERE id=?";
        $stmtProduct = mysqli_prepare($connect, $sqlProduct);
        mysqli_stmt_bind_param($stmtProduct, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmtProduct);
        $resultProduct = mysqli_stmt_get_result($stmtProduct);
        $rowProduct = $resultProduct->fetch_assoc();

        $newSubtotal = $rowProduct['precio'] * $cantidad;

        $sqlCarrito = "UPDATE carrito SET cantidad = ?, subtotal = ?";
        $stmtCarrito = mysqli_prepare($connect, $sqlCarrito);
        mysqli_stmt_bind_param($stmtCarrito, "i", $cantidad, $newSubtotal);
        mysqli_stmt_execute($stmtCarrito);
    }

    public function RemoveProductForCart($idCarrito)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "DELETE FROM carrito WHERE id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idCarrito);
        mysqli_stmt_execute($stmt);
    }
}
