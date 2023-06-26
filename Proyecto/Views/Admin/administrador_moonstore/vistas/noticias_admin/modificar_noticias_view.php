<?php
require_once("controladores/cls_adminnoticias.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<div class="p-3 d-flex justify-content-between">
    <a href="admin_noticias" type="button" class="btn btn-primary">Volver</a>
    <h5>Si deseas editar la imagen elimina la noticia y vuelve crearla.</h5>
</div>
<div class="container">
    <br>
    <form method="POST" action="modificar_no" enctype="multipart/form-data">
        <?php
            $obj_noticias = new cls_adminoticias();
            $informacion=$obj_noticias->consultar_datos_form($id);
            echo $informacion;
        ?>
    </form>
</div>