<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <script src="https://www.paypal.com/sdk/js?client-id=AWV3HPj1tDH8jqxHzl-OWYzE99B60CGg4r_cnBDPlg9gpo-bIcKKgxV0U_wup0I4qYlX7JsRg27Bg4TA&currency=USD">
    </script>

    <style>
        #paypal-button-container {
            margin: 30px;
        }
    </style>

    <?php
    @session_start();

    require_once('../Header.php');

    include('../../Models/ClassUser.php');
    include('../../Models/ClassCarrito.php');
    $objUser = new Users();
    $objCarrito = new Carrito();


    $idCarritos = $_POST['idCarrito'];
    $productos = $_POST['Producto'];
    $precios = $_POST['Precio'];
    $cantidades = $_POST['Cantidad'];
    $subtotales = $_POST['Subtotal'];
    $total = $_POST['total'];
    $idProducto = $_POST['idProduct'];
    ?>
</head>

<body>
    <header>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                            <a href="http://localhost/Proyecto/" class="nav-link active"> <i class="fa-solid fa-house"></i> Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active"> <i class="fa-solid fa-people-group"></i> Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active"><i class="fa-sharp fa-solid fa-address-card"></i> Contactanos</a>
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

    <main>
        <div class='container mt-4'>
            <div class="row">
                <div class="col-8">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < count($idCarritos); $i++) { ?>
                                <tr>
                                    <td><?php echo $productos[$i]; ?></td>
                                    <td><?php echo $precios[$i]; ?></td>
                                    <td><?php echo $cantidades[$i]; ?></td>
                                    <td style="text-align:right"><?php echo "$" . $subtotales[$i]; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"></td>
                                <td style="text-align:right"><?php echo "$" . $total; ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="col-4">
                    <div id="paypal-button-container">

                    </div>
                </div>
            </div>
        </div>

        <script>
            paypal.Buttons({
                style: {
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: <?php echo $total ?>
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    actions.order.capture().then(function(detalles) {
                        console.log(detalles);
                        let url = '/Proyecto/Controllers/OrdenesControllers/PagosControllers.php';
                        let datos = {
                            detalles: detalles,
                            productos: <?php echo json_encode($productos); ?>,
                            precios: <?php echo json_encode($precios); ?>,
                            cantidades: <?php echo json_encode($cantidades); ?>,
                            idProduct: <?php echo json_encode($idProducto); ?>
                        };

                        console.log(datos);

                        return fetch(url, {
                                method: 'post',
                                headers: {
                                    'content-type': 'application/json'
                                },
                                body: JSON.stringify(datos)
                            })
                            .then(function(response) {
                                // Redirigir a una dirección diferente después de completar la operación
                                window.location.href = '/Proyecto/Views/Ordenes/CompraCompleted.php';
                                setTimeout(function() {
                                    window.location.href = '/Proyecto/Index.php';
                                }, 1000);
                            });
                    });
                }

            }).render('#paypal-button-container');
        </script>


    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>