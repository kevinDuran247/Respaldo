<?php
require_once("controladores/cls_adminproductos.php");
$obj_productos=new cls_adminproductos();
if(isset($_GET['id'])){
    $idProducto = $_GET['id'];
    $categoria = $_GET['categoria'];
}
?>
<div class="p-3">
    <a href="admin_productos" type="button" class="btn btn-primary">Volver</a>
</div>
<div class="container">
    <form method="POST" action="modificar_pro" id="form" enctype="multipart/form-data" onsubmit="return validarFormulario()">
        <div class='form-container'>
            <div class='form-column'>

                <?php
                    $informacion=$obj_productos->consultar_datos_form($idProducto);
                    echo $informacion;
                ?>

                <div class="mb-3">
                    <label class="form-label">Categoria:</label>
                    <select class="form-select" name="categoria" id="categoria" required>
                        <option value="<?php echo $categoria?>"><?php echo $categoria?></option>
                        <?php
                            require_once('controladores/cls_admincategorias.php');
                            $obj_equipos = new cls_admincategorias;
                            echo $obj_equipos->consultar_selectNot($categoria);
                        ?>
                    </select>
                </div>

            </div>

            <div class="form-column">
                <div class='mb-3'>
                        <label class='form-label'>Reseleccione la talla: (Opción multiple)</label><br>
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='XS'> XS
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='S'> S<br>
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='M'> M
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='L'> L <br>
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='XL'> XL
                        <input type='checkbox' class='form-check-input' name='tallas[]' value='XXL'> XXL <br>
                </div>

                <div class="mb-3">
                    <br>
                    <h4><b>Tienes que volver a seleccionar las fotos:</b></h4>
                    <label class="form-label"><b>Imagen principal del producto:</b></label>
                    <input type="file" class="form-control" accept="image/*" name="imagenPrincipal"
                        onchange="mostrarVistaPrevia(event)" required>
                    <br>
                    <img id="vista-previa" src="#" alt="Vista previa de la foto" class='img-thumbnail img-fluid'
                        style="width: 95px; height: auto; display: none;">
                </div>

                <div class="mb-3">
                    <label class="form-label"><b>Álbum de imágenes del producto:</b></label>
                    <p>* Agrega todas las imágenes que vas agregar de una vez, de lo contrario el álbum se vaciará si
                        intentas agregar una nueva, y tendras que agregarlas todas de nuevo.</p>
                    <input type="file" class="form-control" name="albumImganes[]" id="imageInput" accept="image/*"
                        multiple><br>
                    <div id="imagePreview" class="d-flex flex-wrap justify-content-between"></div>
                    <button type="button" class="btn btn-primary" id="clearButton">Vaciar albúm</button>
                </div>

                <div class="text-end">
                    <button type="submit" name="btnModificarProducto" class="btn btn-warning">MODIFICAR PRODUCTO</button>
                </div>

            </div>
        </div>
    </form>
    <script src="js/albumFotos.js"></script>
    <script>
    const colorSelect = document.getElementById("color-select");
    const otroColorDiv = document.getElementById("otro-color");
    colorSelect.addEventListener("change", function() {
        if (colorSelect.value === "otro") {
            otroColorDiv.classList.remove("d-none");
        } else {
            otroColorDiv.classList.add("d-none");
        }
    });


    function validarFormulario() {
        var tallas = document.getElementsByName('tallas[]');
        var seleccionada = false;

        // Verificar si al menos una casilla está seleccionada
        for (var i = 0; i < tallas.length; i++) {
            if (tallas[i].checked) {
                seleccionada = true;
                break;
            }
        }

        // Mostrar mensaje de error si ninguna casilla está seleccionada
        if (!seleccionada) {
            alert('Por favor, seleccione al menos una talla.');
            return false; // Evita el envío del formulario
        }

        return true; // Envía el formulario
    }
    </script>
</div>