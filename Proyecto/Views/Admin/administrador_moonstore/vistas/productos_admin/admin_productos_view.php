<?php
    require_once("controladores/cls_adminproductos.php");
?>


<div class="d-flex justify-content-between p-4">
    <a href="http://localhost/Proyecto/Views/Admin/administrador_moonstore/vistas/productos_admin/reporte_productos.php"
        class="pdfs bx bx-download nav_icon align-self-start"> CatalogoProductos.pdf
    </a>
    <a href="form_productos" type="button" class="btn btn-primary align-self-end">AGREGAR NUEVO PRODUCTO</a>
</div>



<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Img principal</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Tallas</th>
                <th scope="col">Color</th>
                <th scope="col">Existencias</th>
                <th scope="col">Categoria</th>
                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $obj_productos = new cls_adminproductos();
            $informacion=$obj_productos->consultar_productos();
            echo $informacion;
        ?>
        </tbody>
    </table>
</div>