<?php
define('BASE_URL', '');
// require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

function menu()
{
    ob_start();
    echo '
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="bi bi-list"></i> Menú
            </button>
            <a class="navbar-brand ms-3" href="#">FBS</a>
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> Usuario
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start sidebar-offcanvas" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menú Principal</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <nav class="nav flex-column">
                <a class="nav-link active" href="' . BASE_URL . 'index.php">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a class="nav-link" href="' . BASE_URL . 'views/inventario.php">
                    <i class="bi bi-box-seam me-2"></i> Inventario
                </a>
                <a class="nav-link" href="' . BASE_URL . 'views/ventas.php">
                    <i class="bi bi-cart4 me-2"></i> Ventas
                </a>
                <a class="nav-link" href="' . BASE_URL . 'views/articulos.php">
                    <i class="bi bi-basket me-2"></i> Artículos
                </a>
                <a class="nav-link" href="' . BASE_URL . 'views/entrada_almacen.php">
                    <i class="bi bi-truck me-2"></i> Entradas de Almacén
                </a>

                <hr class="my-3 border-secondary">

                <a class="nav-link" href="#">
                    <i class="bi bi-gear me-2"></i> Configuraciones
                </a>
                <a class="nav-link" href="#">
                    <i class="bi bi-question-circle me-2"></i> Ayuda
                </a>
            </nav>
        </div>
    </div>

    <style>
        .sidebar-offcanvas {
            width: 270px;
            background-color: var(--bg-dark-light) !important;
        }

        .navbar {
            background-color: var(--bg-dark-light) !important;
        }

        .nav-link {
            color: var(--text-color) !important;
        }
    </style>
    ';
    return ob_get_clean();
}
?>
