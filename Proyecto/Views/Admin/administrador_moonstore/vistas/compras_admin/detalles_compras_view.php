<?php
require_once("controladores/cls_admincompras.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<style>
    @keyframes bounce {
        0% {
            transform: translateX(0);
        }
        50% {
            transform: translateX(-10px);
        }
        100% {
            transform: translateX(0);
        }
    }

    @keyframes color-change {
        0% {
            background-color: #007bff;
        }
        
        100% {
            background-color: #007bff;
        }
    }

    .animate-button {
        animation: bounce 1s infinite;
    }

    .animate-button:hover {
        animation: color-change 1s infinite;
    }
</style>

<div class="p-3">
    <a href="admin_compras" type="button" class="btn btn-primary animate-button"><- Regresar</a>
</div>
<div class="container" style="width: 500px;">
<div class="pdfConteiner">
    <a href="http://localhost/Proyecto/Views/Admin/administrador_moonstore/vistas/compras_admin/factura_usuario.php?id=<?php echo $id;?>"
        class="pdfs bx bx-download nav_icon"> Factura.pdf
    </a>
</div>
    <br>
    <?php echo"ID COMPRA: ".$id; ?>
    <br>
    <br>
    <div class="table-responsive">
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    
                    $obj_compras = new cls_admincompras();
                    $informacion=$obj_compras->consultar_detalles($id);
                    echo $informacion;
                
                ?>
            </tbody>
        </table>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <th scope="col">Prendas</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $obj_compras = new cls_admincompras();
                    $informacion=$obj_compras->consultar_totales($id);
                    echo $informacion; ?>
            </tbody>
        </table>
    </div>
</div>