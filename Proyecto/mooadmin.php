<?php
session_start();
?>

<style>
    body {
        background: #eee url(http://subtlepatterns.com/patterns/sativa.png);
    }

    html,
    body {
        position: relative;
        height: 100%;
    }

    .login-container {
        position: relative;
        width: 300px;
        margin: 80px auto;
        padding: 20px 40px 40px;
        text-align: center;
        background: #fff;
        border: 1px solid #ccc;
    }

    #output {
        position: absolute;
        width: 300px;
        top: -75px;
        left: 0;
        color: #fff;
    }

    #output.alert-success {
        background: rgb(25, 204, 25);
    }

    #output.alert-danger {
        background: rgb(228, 105, 105);
    }


    .login-container::before,
    .login-container::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 3.5px;
        left: 0;
        background: #fff;
        z-index: -1;
        -webkit-transform: rotateZ(4deg);
        -moz-transform: rotateZ(4deg);
        -ms-transform: rotateZ(4deg);
        border: 1px solid #ccc;

    }

    .login-container::after {
        top: 5px;
        z-index: -2;
        -webkit-transform: rotateZ(-2deg);
        -moz-transform: rotateZ(-2deg);
        -ms-transform: rotateZ(-2deg);

    }

    .avatar {
        width: 100px;
        height: 100px;
        margin: 10px auto 30px;
        border-radius: 100%;
        border: 2px solid #aaa;
        background-size: cover;
    }

    .avatar img {
        position: relative;
        width: 100px;
        height: 100px;
        margin: 10px auto 30px;
        border-radius: 100%;
        border: 2px solid #aaa;
        background-size: cover;
        bottom: 12px;
        right: 2px;
        border: none;
        object-fit: cover;
    }

    .form-box input {
        width: 100%;
        padding: 10px;
        text-align: center;
        height: 40px;
        border: 1px solid #ccc;
        ;
        background: #fafafa;
        transition: 0.2s ease-in-out;

    }

    .form-box input:focus {
        outline: 0;
        background: #eee;
    }

    .form-box input[type="text"] {
        border-radius: 5px 5px 0 0;
        text-transform: lowercase;
    }

    .form-box input[type="password"] {
        border-radius: 0 0 5px 5px;
        border-top: 0;
    }

    .form-box button.login {
        margin-top: 15px;
        padding: 10px 20px;
    }

    .animated {
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @-webkit-keyframes fadeInUp {
        0% {
            opacity: 0;
            -webkit-transform: translateY(20px);
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        0% {
            opacity: 0;
            -webkit-transform: translateY(20px);
            -ms-transform: translateY(20px);
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            -ms-transform: translateY(0);
            transform: translateY(0);
        }
    }

    .fadeInUp {
        -webkit-animation-name: fadeInUp;
        animation-name: fadeInUp;
    }

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

    .alert {
        text-align: center;
        padding: 20px;
        background-color: #e42f25;
        color: white;
        position: relative;
        animation: slideIn 0.4s, fadeOut 0.4s 1s;
        width: 50%;
        margin: auto;
        margin-top: 10px;
        font-family: JetBrains Mono NL;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }

    @keyframes slideIn {
        from {
            top: -50px;
        }

        to {
            top: 0;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }

        to {
            opacity: 0;
        }
    }
</style>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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

<div class="container">
    <div class="login-container">
        <div id="output">
        </div>
        <div class="avatar">
            <img src="Imagenes/Fotos_de_perfil/user2.jpg" alt="" srcset="">
        </div>
        <div class="form-box">
            <form action="" id="Login" method="">
                <input id="user" type="text" placeholder="admin">
                <input type="password" placeholder="password" id="password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Script para a la alerta y para el proceso del formulario
    $(document).ready(function() {
        $('#Login').on('submit', function(e) {
            e.preventDefault(); // Evita el comportamiento de envío predeterminado del formulario

            var email = $('#user').val();
            var password = $('#password').val();

            if (email === '' || password === '') {
                // Muestra la alerta sin recargar la página
                $('#alert').html('<span class="closebtn" onclick="closeAlert()">&times;</span>RELLENE LOS CAMPOS VACIOS').addClass('error').show();

                var tiempoDesaparicion = 2000;

                // Ocultar la alerta después del tiempo especificado
                setTimeout(function() {
                    $('#alert').hide();
                }, tiempoDesaparicion);

            } else {
                window.location.href = 'Controllers/AdminController.php?email=' + encodeURIComponent(email) + '&password=' + encodeURIComponent(password);
            }
        });
    });

    function closeAlert() {
        var alert = document.getElementById("error");
        alert.style.display = "none";
    }

    setTimeout(function() {
        closeAlert();
    }, 4000);
</script>