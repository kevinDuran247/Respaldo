<?php
require_once("controladores/cls_admincompras.php");
$obj_compras = new cls_admincompras();

$email ="";
$fecha ="";
$informacionFiltrada = $obj_compras->filtrar_Compras($email,$fecha);

if(isset($_POST["btnBuscarEmail"])){
    $fecha ="";
    $informacionFiltrada = $obj_compras->filtrar_compras($_POST['email'],$fecha);
}
if(isset($_POST["btnVerTodos"])){
    $email ="";
    $fecha ="";
    $informacionFiltrada = $obj_compras->filtrar_Compras($email,$fecha);
}
if(isset($_POST["btnBuscarFecha"])){
    $email ="";
    $informacionFiltrada = $obj_compras->filtrar_compras($email, $_POST['fecha']);
}


?>
<style>
.forms {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
</style>
<div class="pdfConteiner">
    <a href="http://localhost/Proyecto/Views/Admin/administrador_moonstore/vistas/compras_admin/reportes_compras.php"
        class="pdfs bx bx-download nav_icon"> ReporteTodos.pdf
    </a>
</div>
<?php 
$total = $obj_compras->dinero_total();
echo $total;
?>
<br>
<div class="forms">
    <form method="POST">
        <input type="text" name="email" placeholder="Buscar por email" required>
        <input type="submit" name="btnBuscarEmail" value="Buscar" onclick="guardarEstadoBtnVerTodos()">
    </form>
    <form method="POST">
        <input type="submit" name="btnVerTodos" id="btnVerTodos" value="Volver a ver todos" style="display: none;"
            onclick="ocultarBtnVerTodos()">
    </form>
    <form method="POST" action="">
        <input type="date" name="fecha" required>
        <input type="submit" name="btnBuscarFecha" value="Buscar" onclick="guardarEstadoBtnVerTodos()">
    </form>
</div>
<br>
<div class="table-responsive">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Transacción Id</th>
                <th scope="col">fecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Nombre usuario</th>
                <th scope="col">Usuario Id</th>
                <th scope="col">Email</th>
                <th scope="col">Cliente Id</th>
                <th scope="col">Total</th>
                <th scope="col" style="text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
                    echo $informacionFiltrada; 
                
                    
                    ?>
        </tbody>
    </table>
</div>

<script>
function guardarEstadoBtnVerTodos() {
    localStorage.setItem("btnVerTodosVisible", "true");
}

function ocultarBtnVerTodos() {
    localStorage.removeItem("btnVerTodosVisible");
    var btnVerTodos = document.getElementById("btnVerTodos");
    btnVerTodos.style.display = "none";
}

// Verificar el estado almacenado al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    var btnVerTodos = document.getElementById("btnVerTodos");
    var btnVerTodosVisible = localStorage.getItem("btnVerTodosVisible");

    if (btnVerTodosVisible === "true") {
        btnVerTodos.style.display = "block";
    }
});
</script>