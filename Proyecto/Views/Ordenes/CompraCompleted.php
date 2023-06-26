<?php

require_once('../Header.php');
session_start();

ob_clean();

// Recupera los datos de la sesión
$idTransaccion = $_SESSION['idTransaccion'];
$monto = $_SESSION['monto'];
$status = $_SESSION['status'];
$dateNew = $_SESSION['dateNew'];
$idCliente = $_SESSION['idCliente'];
$idUsuario = $_SESSION['idUsuario'];
$productos = $_SESSION['productos'];
$precios = $_SESSION['precios'];
$cantidades = $_SESSION['cantidades'];
$idProducts = $_SESSION['idProductos'];

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    td:nth-child(even) {
        background-color: #f9f9f9;
    }

    .center {
        text-align: center;
    }
</style>




<div class="container mt-4">
    <table>
        <tr>
            <th colspan="2" class="center">
                <h4>FACTURA</h4>
            </th>
        </tr>
        <tr>
            <th>ID de Transacción:</th>
            <td><?php echo $idTransaccion; ?></td>
        </tr>
        <tr>
            <th>Total:</th>
            <td><?php echo $monto; ?></td>
        </tr>
        <tr>
            <th>Estado:</th>
            <td><?php echo $status; ?></td>
        </tr>
        <tr>
            <th>Fecha:</th>
            <td><?php echo $dateNew; ?></td>
        </tr>
        <tr>
            <th>ID de Cliente:</th>
            <td><?php echo $idCliente; ?></td>
        </tr>
        <tr>
            <th>Usuario:</th>
            <td><?php echo $_SESSION['email']; ?></td>
        </tr>
    </table>
    <br>

    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        <?php for ($i = 0; $i < count($productos); $i++) { ?>
            <tr>
                <td><?php echo $productos[$i]; ?></td>
                <td>$<?php echo $precios[$i]; ?></td>
                <td><?php echo $cantidades[$i]; ?></td>
                <td>$<?php echo $precios[$i] * $cantidades[$i]; ?></td>
            </tr>
        <?php } ?>
    </table>

    <div class="row">
        <h3>DETALLES ENVIO:</h3>
        <p>Ponte en contacto con el dueño para determinar el envío:</p>
        <a href="https://api.whatsapp.com/send?phone=64308636&text=Hola, he realizado una compra en tu pagina web" target="_blank">Enviar mensaje de WhatsApp</a>
    </div>


</div>




<?php

require '../../Librerias/vendor/autoload.php';

$html = ob_get_clean();

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("factura.pdf", array('Attachment' => true));

unset($_SESSION['idTransaccion']);
unset($_SESSION['monto']);
unset($_SESSION['status']);
unset($_SESSION['dateNew']);
unset($_SESSION['idCliente']);
unset($_SESSION['idUsuario']);
unset($_SESSION['productos']);
unset($_SESSION['precios']);
unset($_SESSION['cantidades']);
unset($_SESSION['idProductos']);


?>