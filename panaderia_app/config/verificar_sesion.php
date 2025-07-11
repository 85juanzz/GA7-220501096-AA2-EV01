<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['id_empleado'])) {
    header('Location: /panaderia_app/login.php');
    exit;
}

$es_admin = (isset($_SESSION['puesto']) && $_SESSION['puesto'] === 'Administrador');
?>
