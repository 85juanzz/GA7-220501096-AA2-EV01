<?php
require_once './config/verificar_sesion.php';
require_once './templates/header.php';
?>

<div class="container-fluid">

    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm welcome-banner">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-store me-2"></i>Bienvenido, <?php echo htmlspecialchars(explode(' ', $_SESSION['nombre_empleado'])[0]); ?>!
            </h1>
            <p class="col-md-8 fs-4">Este es el panel de control del sistema de gestión "El Buen Sabor".</p>
            <hr class="my-4">
            <p>Desde aquí puedes acceder a las herramientas y módulos disponibles según tu perfil.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        
        <?php if ($es_admin): ?>
        <div class="col-md-6 col-lg-5">
            <div class="card text-center shadow-sm module-card">
                <div class="card-body">
                    <div class="card-icon mb-3">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <h5 class="card-title">Gestión de Empleados</h5>
                    <p class="card-text">Añade, consulta, modifica y elimina los registros de los empleados. (CRUD Completo).</p>
                    <a href="/panaderia_app/modulos/empleados/index.php" class="btn btn-primary">
                        Acceder al Módulo <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
    </div>

</div>

<?php
require_once './templates/footer.php';
?>