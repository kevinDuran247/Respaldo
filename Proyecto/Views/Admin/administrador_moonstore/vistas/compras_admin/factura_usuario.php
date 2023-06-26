<?php
ob_start();

require_once("../../controladores/cls_admincompras.php");
$obj_compras = new cls_admincompras();
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$informacionDetalles = $obj_compras->consultar_detalles($id);
$dineroTotal = $obj_compras->consultar_totales($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        font-family: Arial, sans-serif;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    thead {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>

<body>
    <div class="table-responsive">
        <h3>
            <center><b>Detalles de la orden</b></center>
        </h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php    
                echo $informacionDetalles;
            ?>
            </tbody>
        </table>
        <br>
        <table>
        <thead>
                <tr>
                    <th scope="col">Prendas</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php    
                echo $dineroTotal;
            ?>
            </tbody>
        </table>
    </div>

    <?php
    $html=ob_get_clean();

    require_once '../../librerias/dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
   // $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream('factura.pdf',array("Attachment"=>0));
?>