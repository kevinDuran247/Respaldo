<?php
session_start();

if ($_SESSION['typeUser'] == "Usuario") {
    header('Location:/Proyecto/Index.php');
} elseif ($_SESSION['typeUser'] == "Administrador") {
    header('Location:/Proyecto/Views/Admin/administrador_moonstore/index_admin.php');
}
