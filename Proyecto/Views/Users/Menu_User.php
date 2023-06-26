<?php
@session_start();
include('Models/ClassUser.php');
include('Models/ClassCarrito.php');
$objUser = new Users();
$objCarrito = new Carrito();
?>

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
                        <a href="http://localhost/Proyecto/" class="nav-link active"> </i> Inicio</a>
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
                            <li><a class='dropdown-item' href='/Proyecto/Register.php'>Register</a></li>";
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