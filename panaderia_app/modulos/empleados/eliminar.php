<?php
require_once '../../config/verificar_sesion.php';
if (!$es_admin) {
    die(header('Location: index.php?status=denied'));
}

require_once '../../config/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php?status=error');
    exit;
}

$id_empleado_a_eliminar = (int)$_GET['id'];
$id_empleado_logueado = $_SESSION['id_empleado'];

if ($id_empleado_a_eliminar === $id_empleado_logueado) {
    header("Location: index.php?status=error_self_delete");
    exit;
}

$check_sql = "SELECT COUNT(*) as total FROM Ventas WHERE id_empleado = ?";
$check_stmt = $conexion->prepare($check_sql);
$check_stmt->bind_param("i", $id_empleado_a_eliminar);
$check_stmt->execute();
$resultado = $check_stmt->get_result()->fetch_assoc();
$check_stmt->close();

if ($resultado['total'] > 0) {
    header("Location: index.php?status=error_inuse");
    exit;
}

$sql = "DELETE FROM Empleados WHERE id_empleado = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_empleado_a_eliminar);

if ($stmt->execute()) {
    header("Location: index.php?status=deleted");
} else {
    header("Location: index.php?status=error");
}

$stmt->close();
$conexion->close();
?>