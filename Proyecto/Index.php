<?php
function verificarArchivoConfig()
{
    $archivoConfig = 'Models/Config.php';
    return file_exists($archivoConfig);
}

// Verificar si el archivo Config.php existe
if (!verificarArchivoConfig()) {
    // Redirigir al instalador
    header('Location: InstaladorBD.php');
    exit();
}

?>

<?php
session_start();
require_once('Views/Header.php');
require_once('Models/ClassProducts.php');
require_once('Models/ClassCategorias.php');
$objProduct = new Products();
$objCategory = new Categorias();
?>


<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="CSS/style.css">
<script src="JS/script.js"></script>

<style>
    html,
    body {
        height: 100%;
    }

    .sticky-footer {
        flex-shrink: none;
    }

    #productos img {
        width: 200px;
        height: 200px;
        margin: auto;
        padding: 20px;
        object-fit: contain;
    }

    #contenedor {
        margin-bottom: 100px;
    }

    #cardProduct {
        height: 200px;
    }

    #rowProduct {
        margin-bottom: 10px;
    }

    .modal-overlay {
        position: fixed;
        z-index: 9998;
        /* Un índice de apilamiento inferior al modal */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        /* Color de fondo semitransparente */
        pointer-events: auto;
        /* Permite eventos de clic en el overlay */
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 50px auto 0;
        padding: 20px;
        border: none;
        border-radius: 10px;
        width: 80%;
        max-width: 600px;
    }

    .modale {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modale-content {
        background-color: #fefefe;
        margin: 50px auto 0;
        padding: 20px;
        border: none;
        border-radius: 10px;
        width: 40%;
        max-width: 300px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }
</style>


<?php require('Views/Users/Menu_User.php'); ?>

<?php
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
?>
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong><?php echo $alert ?></strong>
    </div>

    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function(alert) {
            new bootstrap.Alert(alert)
        })
    </script>

<?php
    unset($_SESSION['alert']);
} ?>

<div class='container' id="contenedor">

    <div class="row mt-4">
        <div class="col-1" style="margin-top:10px">
            Busqueda:
        </div>

        <div class="col-3">
            <div class="mb-3">
                <select class="form-select form-select" name="" id="filter-selectCategory">
                    <option selected disabled>Filtrar por categoria</option>
                    <?php
                    $data = $objCategory->consultar_selectCategorias();
                    echo $data;
                    ?>
                </select>
            </div>
        </div>
    </div>


    <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5' id="productos">

        <?php
        $data = $objProduct->consultProducts();
        echo $data;
        ?>

    </div>




</div>

<footer class="footer fixed-bottom bg-light sticky-footer">
    <div class="container">
        <nav aria-label="Menú de Paginación">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                </li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>

<script>
    //Script para mostrar los detalles del producto
    function showDetails(productId) {
        // Realizar la petición AJAX para obtener el contenido HTML desde PHP
        $.ajax({
            url: 'Views/Products/DetailsProducts.php',
            method: 'GET',
            data: {
                productId: productId
            },
            success: function(response) {
                // Crear el elemento del modal
                var modal = document.createElement('div');
                modal.className = 'modal';
                modal.innerHTML =
                    '<div class="modal-content">' +
                    '<span class="close" onclick="closeModal()">&times;</span>' +
                    '<h3 ' + 'class=' + 'text-center' + '>DETALLES DEL PRODUCTO</h3> ' +
                    response +
                    '</div>';

                // Agregar el modal al cuerpo del documento
                document.body.appendChild(modal);

                // Mostrar el modal
                modal.style.display = 'block';


                //Input de contador de productos 
                $(document).ready(function() {
                    $('#incrementBtn').click(function() {
                        var currentValue = parseInt($('#quantityInput').val());
                        if (currentValue < parseInt($('#quantityInput').attr('max'))) {
                            $('#quantityInput').val(currentValue + 1);
                        }
                    });

                    $('#decrementBtn').click(function() {
                        var currentValue = parseInt($('#quantityInput').val());
                        if (currentValue > parseInt($('#quantityInput').attr('min'))) {
                            $('#quantityInput').val(currentValue - 1);
                        }
                    });
                });

                //Insertar carrito
                $(document).ready(function() {
                    $('#FormCarrito').submit(function(event) {
                        // Evita que se envíe el formulario de forma predeterminada
                        event.preventDefault();

                        // Obtiene la URL del archivo PHP que procesará el formulario
                        var url = 'Controllers/CarritoControllers/InsertProductCarrito.php';

                        // Obtiene los datos del formulario
                        var formData = $(this).serialize();

                        // Realiza la solicitud AJAX
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            success: function(response) {
                                // Maneja la respuesta del servidor aquí
                                // Actualiza la parte del menú del carrito con la nueva información

                                $('#mostrarElCarrito').html(response);
                            },
                            error: function(xhr, status, error) {
                                // Maneja los errores de la solicitud AJAX aquí
                                console.error(error);
                            }
                        });
                    });
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function closeModal() {
        var modal = document.querySelector('.modal');
        modal.parentNode.removeChild(modal);
    }

    document.getElementById('accountDropdownLink').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace se comporte como un enlace normal

        // Aquí puedes redirigir al usuario a la página deseada
        window.location.href = '/Proyecto/Login.php';
    });
</script>

<?php if (!isset($_SESSION['user'])) : ?>
    <script>
        function showCuenta() {
            var modal = document.createElement('div');
            modal.className = 'modale';
            modal.innerHTML =
                '<div class="modale-content">' +
                '<span class="close" onclick="closeModal1()">&times;</span>' +
                '<h3 class="text-center">INICIA SESION</h3>' +
                '<div class="row">' +
                '<div class="col-sm-6" style="margin:auto">' +
                '<a href="Login.php" class="btn btn-success" >Log In</a>' +
                '</div>' +
                '<div class="col-sm-6" style="margin:auto">' +
                '<a href="Register.php" class="btn btn-warning" >Register</a>' +
                '</div>' +
                '</div>';

            // Agregar el modal al cuerpo del documento
            document.body.appendChild(modal);

            // Mostrar el modal
            modal.style.display = 'block';
        }

        function closeModal1() {
            var modal = document.querySelector('.modale');
            modal.parentNode.removeChild(modal);
        }
    </script>
<?php endif; ?>



<?php require_once('Views/Footer.php'); ?>


<script>
    const filterSelect = $('#filter-selectCategory');

    filterSelect.on('change', handleSearch);

    function handleSearch() {

        const selectedCategory = filterSelect.val();


        $.ajax({
            url: 'Controllers/BusquedasControllers/Products.php',
            method: 'POST',
            data: {
                selectedCategory: selectedCategory
            },
            success: function(response) {

                $('#productos').html(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>