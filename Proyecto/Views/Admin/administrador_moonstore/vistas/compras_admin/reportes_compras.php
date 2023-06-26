<?php
ob_start();

require_once("../../controladores/cls_admincompras.php");
$obj_compras = new cls_admincompras();
$informacionFiltrada = $obj_compras->pdf_Compras();
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

    th, td {
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
        <center><b>COMPRAS DE USUARIOS</b></center>
    </h3>
    <table>
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Transacción Id</th>
                <th scope="col">fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Usuario Id</th>
                <th scope="col">Email</th>
                <th scope="col">Cliente Id</th>
                <th scope="col">Total</th>
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
    $dompdf->stream('ReporteCompras.pdf',array("Attachment"=>0));
?>







