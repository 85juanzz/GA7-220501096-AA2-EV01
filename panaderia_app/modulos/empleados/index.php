<?php
require_once '../../config/verificar_sesion.php';
require_once '../../config/database.php';
require_once '../../templates/header.php';

if (!$es_admin) {
    echo "<div class='alert alert-danger text-center'>
            <i class='fas fa-exclamation-triangle me-2'></i>
            Acceso denegado. Este módulo es solo para administradores.
          </div>";
    require_once '../../templates/footer.php';
    exit;
}

if (isset($_GET['status'])) {
    $mensaje = '';
    $clase_alerta = '';
    switch ($_GET['status']) {
        case 'created': $mensaje = 'Empleado creado exitosamente.'; $clase_alerta = 'success'; break;
        case 'updated': $mensaje = 'Empleado actualizado exitosamente.'; $clase_alerta = 'success'; break;
        case 'deleted': $mensaje = 'Empleado eliminado exitosamente.'; $clase_alerta = 'success'; break;
        case 'error_inuse': $mensaje = '<strong>Error:</strong> No se puede eliminar al empleado porque está asociado a una o más ventas.'; $clase_alerta = 'danger'; break;
        case 'error_self_delete': $mensaje = '<strong>Error:</strong> No puedes eliminar tu propia cuenta de administrador.'; $clase_alerta = 'danger'; break;
        case 'denied': $mensaje = '<strong>Acceso Denegado:</strong> No tienes permiso para realizar esta acción.'; $clase_alerta = 'warning'; break;
        case 'error': $mensaje = 'Ocurrió un error.'; $clase_alerta = 'danger'; break;
    }
    if ($mensaje) {
        echo "<div id='alerta-estado' class='alert alert-{$clase_alerta} alert-dismissible fade show'>{$mensaje}<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

$sql = "SELECT id_empleado, nombre, apellido, puesto, fecha_contratacion, activo FROM Empleados ORDER BY apellido, nombre";
$resultado = $conexion->query($sql);
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestión de Empleados</h2>
    <a href="crear.php" class="btn btn-primary">Añadir Nuevo Empleado</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Puesto</th>
            <th>Fecha Contratación</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($resultado->num_rows > 0) {
            while($empleado = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $empleado['id_empleado'] . "</td>";
                echo "<td>" . htmlspecialchars($empleado['nombre']) . "</td>";
                echo "<td>" . htmlspecialchars($empleado['apellido']) . "</td>";
                echo "<td>" . htmlspecialchars($empleado['puesto']) . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($empleado['fecha_contratacion'])) . "</td>";
                echo "<td><span class='badge " . ($empleado['activo'] ? 'bg-success' : 'bg-secondary') . "'>" . ($empleado['activo'] ? 'Activo' : 'Inactivo') . "</span></td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $empleado['id_empleado'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                if ($_SESSION['id_empleado'] != $empleado['id_empleado']) {
                    echo "<a href='eliminar.php?id=" . $empleado['id_empleado'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro?\");'>Eliminar</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No hay empleados registrados</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php
$conexion->close();
require_once '../../templates/footer.php';
?>