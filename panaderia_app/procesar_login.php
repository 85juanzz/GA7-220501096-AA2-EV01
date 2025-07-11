<?php
session_start();
require_once './config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username_ingresado = $_POST['username'];
    $password_ingresada = $_POST['password'];

    if (empty($username_ingresado) || empty($password_ingresada)) {
        header('Location: login.php?error=1');
        exit;
    }

    $sql = "SELECT id_empleado, nombre, apellido, puesto, password, username FROM Empleados WHERE username = ? AND activo = 1";
    $stmt = $conexion->prepare($sql);
    
    $stmt->bind_param("s", $username_ingresado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 1) {
        $empleado = $resultado->fetch_assoc();
        
        if (password_verify($password_ingresada, $empleado['password'])) {
            $_SESSION['id_empleado'] = $empleado['id_empleado'];
            $_SESSION['nombre_empleado'] = $empleado['nombre'] . ' ' . $empleado['apellido'];
            $_SESSION['puesto'] = $empleado['puesto'];
            $_SESSION['username'] = $empleado['username'];

            header('Location: index.php');
            exit;
        }
    }
    
    header('Location: login.php?error=1');
    exit;
}
?>