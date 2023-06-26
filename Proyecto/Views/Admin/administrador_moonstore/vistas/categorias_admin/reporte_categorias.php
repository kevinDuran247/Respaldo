<?php
ob_start();

require_once("../../controladores/cls_admincategorias.php");
$obj_compras = new cls_admincategorias();
$informacionFiltrada = $obj_compras->reportePdf();
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
        <center><b>CATEGORIAS</b></center>
    </h3>
        <table>
            <thead>
                <tr>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <?php    
                echo $informacionFiltrada;
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
    $dompdf->setPaper('A4', 'landscape');
   // $dompdf->setPaper('letter');
    $dompdf->render();
    $dompdf->stream('ReporteCategorias.pdf',array("Attachment"=>0));
?>