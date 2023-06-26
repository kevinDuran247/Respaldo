<?php 
require_once("controladores/cls_admincategorias.php");
?>

<div class="container">
    <br>
<a href="http://localhost/Proyecto/Views/Admin/administrador_moonstore/vistas/categorias_admin/reporte_categorias.php"
        class="pdfs bx bx-download nav_icon"> Categorias.pdf
    </a>
    <div class="row p-4">

        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCategoria">
                        <?php
                            $obj_categorias = new cls_admincategorias();
                            $informacion=$obj_categorias->consultar_categorias();
                            echo $informacion;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            <form method="POST" id="formularioCategoria">
                <div class="mb-3">
                    <label class="form-label">Nombre de la categoría:</label>
                    <input type="text" class="form-control" name="nombre">

                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción:</label>
                    <textarea class="form-control" name="descripcion" rows="4" cols="50"
                        placeholder="Opcional.."></textarea>
                </div>

                <div class='text-end'>
                    <button type="submit" name="btnAgregarCategoria" class="btn btn-primary">AGREGAR CATEGORIA</button>
                </div>
            </form>
        </div>

    </div>
</div>
