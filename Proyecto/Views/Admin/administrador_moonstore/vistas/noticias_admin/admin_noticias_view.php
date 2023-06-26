<?php
require_once("controladores/cls_adminnoticias.php");
?>
<div class="container">
    <br>
    <form method="POST" id="form" enctype="multipart/form-data">
        <div class="form-column">
            <div class="mb-3">
                <label class="form-label"><b>Imagen de la noticia:</b></label>
                <input type="file" class="form-control" accept="image/*" name="imagen"
                    onchange="mostrarVistaPrevia(event)">
                <img id="vista-previa" src="#" alt="Vista previa de la foto" class='img-thumbnail img-fluid'
                    style="width: 50%; height: auto; display: none; margin-left: auto; margin-right: auto;;">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="titulo" placeholder="Titulo" required>
            </div>
            <div class="mb-3">
                <textarea class="form-control" name="descripcion" rows="4" cols="50"
                    placeholder="Detalles de la noticia" required></textarea>
            </div>
            <div class="text-end">
                <button type="submit" name="btnAgregarNoticia" class="btn btn-primary">PUBLICAR</button>
            </div>
    </form>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col" style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaNoticias">
                <?php
                    $obj_noticias = new cls_adminoticias();
                    $informacion=$obj_noticias->consultar_noticias();
                    echo $informacion;
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function mostrarVistaPrevia(event) {
    var archivo = event.target.files[0];
    var vistaPrevia = document.getElementById('vista-previa');

    if (archivo) {
        var lector = new FileReader();

        lector.onload = function(e) {
            vistaPrevia.src = e.target.result;
            vistaPrevia.style.display = 'block';
        };

        lector.readAsDataURL(archivo);
    } else {
        vistaPrevia.src = '#';
        vistaPrevia.style.display = 'none';
    }
}
</script>