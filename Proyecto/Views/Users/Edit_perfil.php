<?php
@session_start();
require_once('../Header.php'); ?>

<?php
include('../../Models/ClassUser.php');
include('../../Models/ClassCarrito.php');
$objUser = new Users();
$objCarrito = new Carrito();
?>

<link rel="stylesheet" href="../../CSS/style.css">
<script src="../../JS/script.js"></script>



<header>
    <div class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="http://localhost/Proyecto/" class="navbar-brand">
                <strong><i class="fa-solid fa-moon"></i> MOON STORE</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarHeader">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="http://localhost/Proyecto/" class="nav-link active"> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="/Proyecto/Views/Noticias.php" class="nav-link active"> Noticias</a>
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
                    <a style="text-decoration:none;" href="#" class="dropdown-toggle" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

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
                        <?php
                        if (!isset($_SESSION['idUser'])) {
                            echo " 
                            <li><a class='dropdown-item' href='/Proyecto/Views/Users/Perfil_User.php'>Register</a></li>";
                        } else {
                            echo "
                            <li><a class='dropdown-item' href='/Proyecto/Views/Users/Perfil_User.php'>Perfil</a></li>
                            <li><a class='dropdown-item' href='/Proyecto/Views/Ordenes/ComprasUser.php'>Compras</a></li>
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

<?php
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
?>
    <div class="alert" id="error">
        <?php echo $alert ?>
    </div>

<?php
    unset($_SESSION['alert']);
} ?>

<div class="container">
    <div class="row mt-4">
        <form enctype="multipart/form-data" action="/Proyecto/Controllers/UserControllers/EditUser.php" method="POST">
            <?php
            $data = $objUser->selectEditUser($_SESSION['idUser']);
            echo $data;
            ?>
        </form>
    </div>
</div>

<?php require_once('../Footer.php'); ?>

<script>
    document.getElementById('accountDropdownLink').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace se comporte como un enlace normal

        // Aquí puedes redirigir al usuario a la página deseada
        window.location.href = '/Proyecto/Login.php';
    });

    function editarDireccion() {
        // Ocultar/mostrar los elementos select
        var selectContainer = document.getElementById('selectContainer');
        var modeloContainer = document.getElementById('modeloContainer');
        var isVisible = selectContainer.style.display !== 'none';

        selectContainer.style.display = isVisible ? 'none' : 'block';
        modeloContainer.style.display = isVisible ? 'none' : 'block';
    }
</script>

<script>
    // Obtener referencias a los elementos del DOM
    const selectOptions = document.getElementById('departamento');
    const selectOptions2 = document.getElementById('modelo');
    const inputResult = document.getElementById('inputResult');
    const inputResult2 = document.getElementById('inputResult2');

    // Agregar evento de cambio al primer select
    selectOptions.addEventListener('change', function() {
        // Obtener el valor seleccionado del primer select
        const selectedValue = selectOptions.value;

        // Limpiar el valor del segundo select
        inputResult2.value = "";

        // Actualizar el valor del input con el valor seleccionado del primer select
        inputResult.value = selectedValue;
    });

    // Agregar evento de cambio al segundo select
    selectOptions2.addEventListener('change', function() {
        // Obtener el valor seleccionado del segundo select
        const selectedValue2 = selectOptions2.value;

        // Actualizar el valor del input con el valor seleccionado del segundo select
        inputResult2.value = selectedValue2;
    });
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="JS/script.js"></script>