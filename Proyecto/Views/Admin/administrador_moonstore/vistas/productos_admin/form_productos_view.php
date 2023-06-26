<?php
require_once("controladores/cls_adminproductos.php");
?>
<div class="p-3">
    <a href="admin_productos" type="button" class="btn btn-primary">Volver</a>
</div>
<div class="container">
    <form method="POST" id="form" enctype="multipart/form-data" onsubmit="return validarFormulario()">
        <div class="form-container">
            <div class="form-column">
                <div class="mb-3">
                    <label class="form-label">Nombre de producto:</label>
                    <input type="text" class="form-control" name="nombre" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripcion:</label>
                    <textarea class="form-control" name="descripcion" rows="4" cols="50"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Talla: (Opción multiple)</label><br>
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="XS"> XS
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="S"> S<br>
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="M"> M
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="L"> L <br>
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="XL"> XL
                    <input type="checkbox" class="form-check-input" name="tallas[]" value="XXL"> XXL <br>
                </div>

                <div class="mb-3">
                    <label class="form-label">Color:</label>
                    <select class="form-select" name="color" id="color-select" required>
                        <option value="" disabled selected>Seleccionar color</option>
                        <option value="Rojo">Rojo</option>
                        <option value="Azul">Azul</option>
                        <option value="Verde">Verde</option>
                        <option value="Amarillo">Amarillo</option>
                        <option value="Naranja">Naranja</option>
                        <option value="Rosa">Rosa</option>
                        <option value="Morado">Morado</option>
                        <option value="Gris">Gris</option>
                        <option value="Negro">Negro</option>
                        <option value="Blanco">Blanco</option>
                        <option value="Marrón">Marrón</option>
                        <option value="Beige">Beige</option>
                        <option value="Turquesa">Turquesa</option>
                        <option value="Celeste">Celeste</option>
                        <option value="Violeta">Violeta</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div id="otro-color" class="mb-3 d-none">
                    <label class="form-label">Especificar otro color:</label>
                    <input type="text" name="otro-color" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoria:</label>
                    <select class="form-select" name="categoria" id="categoria" required>
                        <option value="" disabled selected>Seleccionar categoria</option>
                        <?php
                            require_once('controladores/cls_admincategorias.php');
                            $obj_equipos = new cls_admincategorias;
                            echo $obj_equipos->consultar_selectCategorias();
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Disponibilidad:</label>
                    <input type="number" class="form-control" name="disponibilidad"  pattern="^\d+(\.\d+)?$" placeholder="0" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Precio:</label>
                    <input type="number" class="form-control" name="precio" step="0.01" min="0" placeholder="00.00"
                        required>
                </div>

            </div>

            <div class="form-column">
                <div class="mb-3">
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
                    <button type="submit" name="btnAgregarProducto" class="btn btn-primary">AGREGAR EL PRODUCTO</button>
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