<?php
require_once '../../config/verificar_sesion.php';
if (!$es_admin) {
    die(header('Location: index.php?status=denied'));
}

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 4. Recoger datos del formulario
    $id_empleado = (int)$_POST['id_empleado'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $username = trim($_POST['username']);
    $puesto = trim($_POST['puesto']);
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $password_plana = $_POST['password'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    if (empty($id_empleado) || empty($nombre) || empty($apellido) || empty($username) || empty($puesto) || empty($fecha_contratacion)) {
        header('Location: editar.php?id=' . $id_empleado . '&status=error_validation');
        exit;
    }

    $sql_parts = [
        "nombre = ?",
        "apellido = ?",
        "username = ?",
        "puesto = ?",
        "fecha_contratacion = ?",
        "activo = ?"
    ];
    $params = [$nombre, $apellido, $username, $puesto, $fecha_contratacion, $activo];
    $types = "sssssi";

    if (!empty($password_plana)) {
        $password_hash = password_hash($password_plana, PASSWORD_DEFAULT);
        $sql_parts[] = "password = ?";
        $params[] = $password_hash;
        $types .= "s";
    }

    $params[] = $id_empleado;
    $types .= "i";

    $sql = "UPDATE Empleados SET " . implode(", ", $sql_parts) . " WHERE id_empleado = ?";
    
    $stmt = $conexion->prepare($sql);
    
    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    
    $stmt->bind_param($types, ...$params);
    
    if ($stmt->execute()) {
        header("Location: index.php?status=updated");
    } else {
        if ($conexion->errno == 1062) {
            header("Location: editar.php?id=" . $id_empleado . "&status=error_duplicate_user");
        } else {
            header("Location: index.php?status=error_db");
        }
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>