<?php
require_once("librerias/contenido.php");
$obj_contenido=new contenido();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js"></script>

    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
    <script src="js/ajaxEliminarCategoria.js"></script>
    <script src="js/ajaxEliminarProducto.js"></script>
    <script src="js/ajaxAgregarCategoria.js"></script>
    <script src="js/ajaxEliminarNoticia.js"></script>
    <script src="js/funciones.js"></script>
    <title>admin</title>
    <style>
        /*Formulario agregar producto*/
        .form-container {
            display: flex;
        }

        .form-column {
            flex: 1;
            padding-right: 20px;
        }
        .pdfConteiner {
            text-align: right;
            padding: 20px;
        }
        .pdfs {
            background-color: red;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
  </style>
</head>


<body id="body-pd">

    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <?php
            require_once("vistas/menu_lateral.php");
        ?>
    </div>

    <!--Container Main start-->
    <main>
        <?php
            require_once($obj_contenido->ver());
        ?>
    </main>
    
</body>

</html>