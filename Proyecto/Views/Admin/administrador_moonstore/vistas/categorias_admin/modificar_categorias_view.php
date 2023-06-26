<?php
require_once("controladores/cls_admincategorias.php");
$obj_categorias=new cls_admincategorias();
if(isset($_GET['id'])){
    $idCategoria = $_GET['id'];
}
?>

<div class="p-3">
    <a href="admin_categorias" type="button" class="btn btn-primary">Volver</a>
</div>
<div class="container p-4 col-md-5">

    <form method="GET" action="modificar_ca" id="formularioCategoria">
        <?php
            $informacion=$obj_categorias->consultar_datos_form($idCategoria);
            echo $informacion;
        ?>

    </form>
</div>