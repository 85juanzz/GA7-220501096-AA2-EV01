<?php
require_once '../../config/verificar_sesion.php';
if (!$es_admin) {
    die(header('Location: index.php?status=denied'));
}

require_once '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $username = trim($_POST['username']);
    $puesto = trim($_POST['puesto']);
    $fecha_contratacion = $_POST['fecha_contratacion'];
    $password_plana = $_POST['password'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    if (empty($nombre) || empty($apellido) || empty($username) || empty($puesto) || empty($fecha_contratacion) || empty($password_plana)) {
        header('Location: crear.php?status=error_validation');
        exit;
    }

    $password_hash = password_hash($password_plana, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Empleados (nombre, apellido, username, puesto, password, fecha_contratacion, activo) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conexion->error);
    }
    
    $stmt->bind_param("ssssssi", $nombre, $apellido, $username, $puesto, $password_hash, $fecha_contratacion, $activo);

    if ($stmt->execute()) {
        header("Location: index.php?status=created");
    } else {
        if ($conexion->errno == 1062) {
            header("Location: crear.php?status=error_duplicate_user");
        } else {
            header("Location: crear.php?status=error_db");
        }
    }

    $stmt->close();
    $conexion->close();
} else {
    header("Location: index.php");
    exit();
}
?>