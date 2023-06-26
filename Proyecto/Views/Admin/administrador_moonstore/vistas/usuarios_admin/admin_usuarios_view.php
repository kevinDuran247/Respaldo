<?php
require_once("controladores/cls_adminusuarios.php");

// Obtener el departamento seleccionado del formulario
$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';

// Consultar usuarios según el departamento seleccionado
$obj_usuarios = new cls_adminusuarios();
$email = "";
$informacion = $obj_usuarios->consultar_usuarios_por_departamento($departamento, $email);

//Buscar por email
if (isset($_POST["btnBuscar"])) {
    $departamento = "";
    $informacion = $obj_usuarios->consultar_usuarios_por_departamento($departamento, $_POST['email']);
}

// Crear el select con opciones de departamento
$departamentos = array(
    'Ahuachapán',
    'Cabañas',
    'Chalatenango',
    'Cuscatlán',
    'La Libertad',
    'La Paz',
    'La Unión',
    'Morazán',
    'San Miguel',
    'San Salvador',
    'San Vicente',
    'Santa Ana',
    'Sonsonate',
    'Usulután'
);
$departamentoOptions = '';
foreach ($departamentos as $dep) {
    $selected = ($departamento === $dep) ? 'selected' : '';
    $departamentoOptions .= "<option value='$dep' $selected>$dep</option>";
}
?>
<style>
    .forms {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
</style>
<div class="container">
    <div class="pdfConteiner">
        <a href="http://localhost/Proyecto/Views/Admin/administrador_moonstore/vistas/usuarios_admin/reporte_usuarios.php" class="pdfs bx bx-download nav_icon"> ReporteTodos.pdf
        </a>
    </div>
    <br>
    <div class="forms">
        <form method="POST">
            <input type="text" name="email" placeholder="Buscar por email" required>
            <input type="submit" name="btnBuscar" value="Buscar">
        </form>
        <form id="departamentoForm" method="POST" action="">
            <select id="selectDepartamento" name="departamento">
                <option disabled selected>Filtrar por departamento</option>
                <option value="">Ver todos</option>
                <?php echo $departamentoOptions; ?>
            </select>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Foto de perfil</th>
                </tr>
            </thead>
            <tbody id="tablaUsuarios">
                <?php echo $informacion; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Agregar un evento de cambio al select de departamentos
    document.getElementById('selectDepartamento').addEventListener('change', function() {
        document.getElementById('departamentoForm').submit(); // Enviar el formulario al seleccionar una opción
    });
</script>