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
        case 'error_validation':
            $mensaje = 'Por favor, completa todos los campos requeridos.';
            $clase_alerta = 'warning';
            break;
        case 'error_duplicate_user':
            $mensaje = '<strong>Error:</strong> El nombre de usuario ya existe. Por favor, elige otro.';
            $clase_alerta = 'danger';
            break;
        case 'error_db':
            $mensaje = 'Ocurrió un error al guardar en la base de datos. Inténtalo de nuevo.';
            $clase_alerta = 'danger';
            break;
    }
    if ($mensaje) {
        echo "<div id='alerta-estado' class='alert alert-{$clase_alerta} alert-dismissible fade show' role='alert'>{$mensaje}<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<h2>Añadir Nuevo Empleado</h2>

<form action="guardar.php" method="POST">
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="username" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="puesto" class="form-label">Puesto</label>
            <select name="puesto" id="puesto" class="form-select" required>
                <option value="" disabled selected>-- Seleccione un puesto --</option>
                <option value="Administrador">Administrador</option>
                <option value="Cajero">Cajero</option>
                <option value="Panadero">Panadero</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" required>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" required>
        <div class="form-text">La contraseña será hasheada por seguridad.</div>
    </div>

    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" checked>
        <label class="form-check-label" for="activo">
            Empleado Activo
        </label>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar Empleado</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php require_once '../../templates/footer.php'; ?>