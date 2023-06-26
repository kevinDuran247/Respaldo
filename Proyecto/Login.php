<?php
session_start();
require_once('Views/Header.php'); ?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
<link rel="stylesheet" href="CSS/style.css">

<style>
    #alert {
        font-family: JetBrains Mono NL;
        display: none;
        /* Ocultar inicialmente la alerta */
        padding: 10px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        width: 50%;
        margin: auto;
        margin-top: 10px;
    }

    #alert .closebtn {
        float: right;
        cursor: pointer;
    }

    #alert.error {
        background-color: #e42f25;
        /* Color de fondo para la alerta de error */
    }

    #alert.success {
        background-color: #22cc22;
        /* Color de fondo para la alerta de éxito */
    }
</style>

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

<div id="alert">

</div>

<body>
    <div id="formWrapper">

        <div id="form">
            <div class="logo">
                <img src="Imagenes/MoonStore.png" alt="" srcset="">
            </div>
            <form id="Login">
                <div class="form-item">
                    <p class="formLabel">Email</p>
                    <input type="email" name="email" id="email" class="form-style" />
                </div>
                <div class="form-item">
                    <p class="formLabel">Password</p>
                    <input type="password" name="password" id="password" class="form-style" />
                    <a href="/Proyecto/Register.php">Register</a>
                </div>
                <div class="form-item-button">
                    <input type="submit" class="login pull-right" value="Log In">
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<script src="JS/script.js"></script>

<?php require_once('Views/Footer.php'); ?>