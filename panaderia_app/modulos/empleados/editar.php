<?php
require_once '../../config/verificar_sesion.php';
require_once '../../config/database.php';
require_once '../../templates/header.php';

if (!$es_admin) {
    echo "<div class='alert alert-danger text-center'><i class='fas fa-exclamation-triangle me-2'></i>Acceso denegado.</div>";
    require_once '../../templates/footer.php';
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id_empleado = (int)$_GET['id'];
$stmt = $conexion->prepare("SELECT * FROM Empleados WHERE id_empleado = ?");
$stmt->bind_param("i", $id_empleado);
$stmt->execute();
$resultado = $stmt->get_result();
$empleado = $resultado->fetch_assoc();
if (!$empleado) {
    echo "<div class='alert alert-danger'>Empleado no encontrado.</div>";
    require_once '../../templates/footer.php';
    exit;
}

if (isset($_GET['status'])) {
    $mensaje = '';
    $clase_alerta = 'warning';
    switch ($_GET['status']) {
        case 'error_validation':
            $mensaje = 'Por favor, completa todos los campos requeridos.';
            break;
        case 'error_duplicate_user':
            $mensaje = '<strong>Error:</strong> El nombre de usuario ya existe. Por favor, elige otro.';
            $clase_alerta = 'danger';
            break;
    }
    if ($mensaje) {
        echo "<div id='alerta-estado' class='alert alert-{$clase_alerta} alert-dismissible fade show'>{$mensaje}<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<h2>Editar Empleado</h2>

<form action="actualizar.php" method="POST">
    <input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado']; ?>">
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($empleado['apellido']); ?>" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($empleado['username']); ?>" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="puesto" class="form-label">Puesto</label>
            <select name="puesto" id="puesto" class="form-select" required>
                <?php
                $puestos = ['Administrador', 'Cajero', 'Panadero'];
                foreach ($puestos as $p) {
                    $selected = ($empleado['puesto'] == $p) ? 'selected' : '';
                    echo "<option value='{$p}' {$selected}>{$p}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="<?php echo $empleado['fecha_contratacion']; ?>" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña (Opcional)</label>
        <input type="password" class="form-control" id="password" name="password">
        <div class="form-text">Dejar en blanco para no cambiar la contraseña actual.</div>
    </div>
    
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" <?php echo ($empleado['activo'] ? 'checked' : ''); ?>>
        <label class="form-check-label" for="activo">Empleado Activo</label>
    </div>
    
    <button type="submit" class="btn btn-success">Actualizar Empleado</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php
$stmt->close();
$conexion->close();
require_once '../../templates/footer.php';
?>