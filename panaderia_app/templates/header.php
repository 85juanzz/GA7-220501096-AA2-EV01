<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$usuario_logueado = isset($_SESSION['id_empleado']);
$es_admin = ($usuario_logueado && isset($_SESSION['puesto']) && $_SESSION['puesto'] === 'Administrador');
$current_page = $_SERVER['SCRIPT_NAME'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Panadería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Ruta absoluta al CSS para que funcione desde cualquier subdirectorio -->
    <link rel="stylesheet" href="/panaderia_app/assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/panaderia_app/index.php">Panadería "El Buen Sabor"</a>
    
    <?php if ($usuario_logueado): ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link <?php echo (str_ends_with($current_page, 'index.php') && strpos($current_page, '/modulos/') === false) ? 'active' : ''; ?>" href="/panaderia_app/index.php">Dashboard</a>
            </li>
            <?php if ($es_admin): ?>
                <li class="nav-item">
                  <a class="nav-link <?php echo (strpos($current_page, '/empleados/') !== false) ? 'active' : ''; ?>" href="/panaderia_app/modulos/empleados/index.php">Empleados</a>
                </li>
            <?php endif; ?>
      </ul>
      <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['nombre_empleado']); ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/panaderia_app/logout.php"><i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión</a></li>
              </ul>
          </li>
      </ul>
    </div>
    <?php endif; ?>
  </div>
</nav>

<main class="container mt-4 flex-grow-1">