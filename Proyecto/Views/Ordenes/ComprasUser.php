<?php
@session_start();

require_once('../Header.php');

include('../../Models/ClassUser.php');
include('../../Models/ClassCarrito.php');
include('../../Models/ClassCompra.php');
$objUser = new Users();
$objCarrito = new Carrito();
?>

<style>
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
        max-width: 100%;
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

<header>

    <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="http://localhost/Proyecto/" class=" navbar-brand">
                <strong><i class="fa-solid fa-moon"></i> MOON STORE</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="http://localhost/Proyecto/" class="nav-link active">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="/Proyecto/Views/Noticias.php" class="nav-link active">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link active"> Contactanos</a>
                    </li>
                    <li class="nav-item" style="margin-left:230px">


                        <a href='/Proyecto/Views/Carrito/ViewCarritoUser.php' class='nav-link active'>
                            <div style='display: flex; align-items: center;'>
                                <i class='fa-solid fa-cart-shopping' style='font-size:25px; padding-left:22px; margin-right:10px;text-align:center;'></i>
                                <div id='mostrarElCarrito'>
                                    <?php echo $data = $objCarrito->consultQuantyCarritoUser(); ?>
                                </div>
                            </div>
                        </a>

                    </li>
                </ul>

                <div class="dropdown">
                    <a style="text-decoration:none;" href="#" class="<?php if (!isset($_SESSION['user'])) {
                                                                            echo "dropdown-toogle";
                                                                        }; ?>dropdown-toggle" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <?php
                        if (!isset($_SESSION['idUser'])) {
                            echo "
                            <img src='/Proyecto/Imagenes/Fotos_de_perfil/User.png
                        ' alt='Foto de perfil' class='rounded-circle' width='38' height='38' style=' object-fit: cover;'>
                            ";
                        } else {
                            $data =  $objUser->imagenPerfil(@$_SESSION['idUser']);
                            echo $data;
                        }
                        ?>

                        <?php
                        if (!isset($_SESSION['user'])) {
                            echo "
                            <span class='ms-2' style='text-decoration: none; color:#fff; font-size:15px'  id='accountDropdownLink'>Inicie Sesion</span>";
                        } else {
                            echo "
                            <span class='ms-2' style='text-decoration: none; color:#fff; font-size:15px'>";
                            echo $_SESSION['email'];
                            echo "</span>";
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">

                        <li><a class="dropdown-item" href="/Proyecto/Views/Users/Perfil_User.php">Perfil</a></li>
                        <li><a class="dropdown-item" href="/Proyecto/Views/Ordenes/ComprasUser.php">Compras</a></li>
                        <?php
                        if (!isset($_SESSION['idUser'])) {
                        } else {
                            echo "
                            <li>
                            <hr class='dropdown-divider'>
                        </li>
                            <li><a class='dropdown-item' href='/Proyecto/Controllers/CloseSessionController.php'>Cerrar sesión</a></li>
                            ";
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</header>



<div class="container mt-4 text-center">
    <?php
    $objCompras = new Compras();
    $data = $objCompras->consultCompras();
    echo $data;
    ?>

    <div id='DetallesCompra'>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // Mostrar el div
    function showCuenta(IDCompra) {
        // Realizar la petición AJAX para obtener el contenido HTML desde PHP
        $.ajax({
            url: '/Proyecto/Controllers/OrdenesControllers/ComprasRealized.php',
            method: 'GET',
            data: {
                IDCompra: IDCompra
            },
            success: function(response) {
                // Crear el elemento del modal
                var modal = document.createElement('div');
                modal.className = 'modal';
                modal.innerHTML =
                    '<div class="modal-content">' +
                    '<div class="container text-center">' +
                    '<h4>DETALLES COMPRA</h4>' +
                    '<span class="close" onclick="closeModal()">&times;</span>' +
                    '<div class="row">' +
                    '<table class="table table-dark text-center" style="font-family:JetBrains Mono NL">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">Estado</th>' +
                    '<th scope="col">Email</th>' +
                    '<th scope="col">Producto</th>' +
                    '<th scope="col">Cantidad</th>' +
                    '<th scope="col">Subtotal</th>' +
                    '</tr>' +
                    '</thead> ' +
                    response +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '</div>' +
                    '</div>'

                // Agregar el modal al cuerpo del documento
                document.body.appendChild(modal);

                // Mostrar el modal
                modal.style.display = 'block';

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
</script>

<?php
require_once('../Footer.php');
?>