<?php
@session_start();
require_once('Connection.php');

class Compras
{

    public function insertCompras($data, $idProductos, $producto, $precios, $cantidad)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "INSERT INTO compras (id_transaccion, fecha, estado, email, id_cliente, total, id_usuario) VALUES(?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "sssssdi", $data['idTransaccion'], $data['date'], $data['status'], $data['email'], $data['idCliente'], $data['monto'], $data['idUsuario']);
        mysqli_stmt_execute($stmt);

        // Obtener el ID de compra recién insertado
        $compraId = mysqli_insert_id($connect);

        $sqlDetalles = "INSERT INTO detalles_compra (id_compra, nombre, precio, cantidad) VALUES(?,?,?,?);";
        $stmtDetalles = mysqli_prepare($connect, $sqlDetalles);

        if ($stmtDetalles) {
            for ($i = 0; $i < count($producto); $i++) {
                mysqli_stmt_bind_param($stmtDetalles, "isdi", $compraId, $producto[$i], $precios[$i], $cantidad[$i]);
                mysqli_stmt_execute($stmtDetalles);
            }
            mysqli_stmt_close($stmtDetalles);
        }

        $sqlDelteCarrito = "DELETE FROM carrito WHERE usuario_id =?;";
        $stmt = mysqli_prepare($connect, $sqlDelteCarrito);
        mysqli_stmt_bind_param($stmt, "i", $data['idUsuario']);
        mysqli_stmt_execute($stmt);


        $sqlSelectDisponibilidad = "SELECT disponibilidad FROM productos WHERE id = ?";
        $stmtSelectDisponibilidad = mysqli_prepare($connect, $sqlSelectDisponibilidad);

        if ($stmtSelectDisponibilidad) {
            $stmtUpdateDisponibilidad = mysqli_prepare($connect, "UPDATE productos SET disponibilidad = ? WHERE id = ?");

            for ($i = 0; $i < count($idProductos); $i++) {
                mysqli_stmt_bind_param($stmtSelectDisponibilidad, "i", $idProductos[$i]);
                mysqli_stmt_execute($stmtSelectDisponibilidad);
                $resultSelectDisponibilidad = mysqli_stmt_get_result($stmtSelectDisponibilidad);
                $rowDisponibilidad = mysqli_fetch_assoc($resultSelectDisponibilidad);

                if ($rowDisponibilidad) {
                    $disponibilidadActual = $rowDisponibilidad['disponibilidad'];
                    $nuevaDisponibilidad = $disponibilidadActual - $cantidad[$i];
                    mysqli_stmt_bind_param($stmtUpdateDisponibilidad, "ii", $nuevaDisponibilidad, $idProductos[$i]);
                    mysqli_stmt_execute($stmtUpdateDisponibilidad);
                }
            }
        }
    }

    public function consultCompras()
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM compras WHERE id_usuario = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['idUser']);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = "";

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $data .= "
            
             <div class='table-responsive'>
                <table class='table table-dark text-center' style='font-family:JetBrains Mono NL'>
                    <thead>
                        <tr>
                            <th scope='col'>ID transacción</th>
                            <th scope='col'>Fecha y hora</th>
                            <th scope='col'>Total</th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td>$row[id_transaccion]</td>
                        <td>$row[fecha]</td>
                        <td>$$row[total]</td>
                        <td><button  onclick='showCuenta($row[id])' class='btn btn-success'>Detalles</button></td>
                    </tbody>
                </table>
            </div>
                ";
            }
            return $data;
        } else {
            $data .= "
                <h4>NO HAZ REALIZADO NINGUNA COMPRA</h4>
            ";
            return $data;
        }
    }

    public function consultDetailsCompras($idCompra)
    {
        $connection = new Connection();
        $connect = $connection->connect();

        $sql = "SELECT * FROM compras c JOIN detalles_compra d ON c.`id` = d.`id_compra` WHERE c.id=?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idCompra);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $data = "";

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {

                $data .= "
            
                    <tr>
                        <td>$row[estado]</td>
                        <td>$row[email]</td>
                        <td>$row[nombre]</td>
                        <td>$row[cantidad]</td>
                        <td>$$row[total]</td>
                    </tr>
                ";
            }
            return $data;
        }
    }
}
