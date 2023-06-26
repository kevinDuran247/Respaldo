<?php
@session_start();
require_once('../../Models/ClassCompra.php');
$objCompras = new Compras();

$JSON = file_get_contents('php://input');
$data = json_decode($JSON, true);


echo "<pre>";
print_r($data);
echo "</pre>";

var_dump($data);

if (is_array($data)) {

    $idTransaccion = $data['detalles']['id'];
    $monto = $data['detalles']['purchase_units'][0]['amount']['value'];
    $status = $data['detalles']['status'];
    $date = $data['detalles']['update_time'];
    $dateNew = date('Y-m-d H:i:s', strtotime($date));
    $email = $data['detalles']['payer']['email_address'];
    $idCliente = $data['detalles']['payer']['payer_id'];
    $idUsuario = $_SESSION['idUser'];

    $productos = $data['productos'];
    $precios = $data['precios'];
    $cantidades = $data['cantidades'];
    $idProducts = $data['idProduct'];

    $_SESSION['idTransaccion'] = $idTransaccion;
    $_SESSION['monto'] = $monto;
    $_SESSION['status'] = $status;
    $_SESSION['dateNew'] = $dateNew;
    $_SESSION['idCliente'] = $idCliente;
    $_SESSION['idUsuario'] = $idUsuario;
    $_SESSION['productos'] = $productos;
    $_SESSION['precios'] = $precios;
    $_SESSION['cantidades'] = $cantidades;
    $_SESSION['idProductos'] = $idProducts;


    $datos = array(
        "idTransaccion" => $idTransaccion,
        "monto" => $monto,
        "status" => $status,
        "date" => $dateNew,
        "email" => $email,
        "idCliente" => $idCliente,
        "idUsuario" => $idUsuario
    );
    $objCompras->insertCompras($datos, $idProducts, $productos, $precios, $cantidades);
}
