<?php
@session_start();

require_once('../Header.php');

include('../../Models/ClassUser.php');
include('../../Models/ClassCarrito.php');
$objUser = new Users();
$objCarrito = new Carrito();
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .header {
        background-color: #333;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-family: Impact;
        border: none;
    }

    .cart {
        margin: 20px auto;
        width: 700px;
        border-collapse: collapse;
    }

    .cart th,
    .cart td {
        padding: 10px;
        text-align: center;

    }

    .cart td {
        border-right: rgb(143, 140, 140) 2px solid;
        border-bottom: rgb(143, 140, 140) 2px solid;
    }

    .cart thead {
        color: #000;
        font-size: 15px;
        font-family: JetBrains Mono NL;
    }

    .cart tfoot {
        background-color: #f9f9f9;
        font-weight: bold;
    }

    .cart tfoot td {
        padding: 10px;
    }

    .cart tfoot .total {
        text-align: right;
    }

    .button {
        display: inline-block;
        padding: 10px;
        background-color: #e74c3c;
        color: #ffffff;
        border: none;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
        width: 50px;
        height: 50px;
    }

    .button:hover {
        background-color: #c0392b;
    }

    .button::before,
    .button::after {
        content: '';
        position: absolute;
        height: 2px;
        width: 15px;
        background-color: #ffffff;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(45deg);
    }

    .button::after {
        transform: translate(-50%, -50%) rotate(-45deg);
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
                        <a href="#" class="nav-link active">Contactanos</a>
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



<div class='header'>
    <h1>Carrito de Compras</h1>
</div>

<main>
    <div class="container">

        <div class='row'>
            <div class="col">
                <form action='/Proyecto/Controllers/CarritoControllers/EliminateProductCarrito.php' method='POST' id='FormEliminate'>
                    <table class="cart text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th colspan="2">Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $data = $objCarrito->consultCarritoUser();
                            echo $data;
                            ?>

                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col mx-auto d-flex justify-content-center align-items-center">
                <form action='/Proyecto/Views/Ordenes/Pago.php' method='POST' id='FormProcesarPago'>
                    <?php
                    $data = $objCarrito->PagarCarrito();
                    echo $data;
                    ?>
                </form>
            </div>
        </div>

    </div>


</main>

<script>
    function enviarFormulario(formularioId) {
        if (formularioId === 'FormEliminate') {
            document.getElementById('FormEliminate').submit();
        } else if (formularioId === 'FormProcesarPago') {
            document.getElementById('FormProcesarPago').submit();
        }
    }
</script>



<script>
    function Reload() {
        var url = '/Proyecto/Views/Carrit/ViewCarrito.php';
        window.location.href = url;
    }

    document.getElementById('accountDropdownLink').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace se comporte como un enlace normal

        // Aquí puedes redirigir al usuario a la página deseada
        window.location.href = '/Proyecto/Login.php';
    });
</script>


<?php require_once('../Footer.php'); ?>