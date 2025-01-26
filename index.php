<?php
session_start();

// Intenta incluir el archivo de configuración
// echo 'http://' . $_SERVER['HTTP_HOST'] . '/inventarioFBS/config/db.php';
// echo 'http://' . $_SERVER['HTTP_HOST'] . '/config/db.php';
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/inventarioFBS/config/db.php')) {
    try {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/inventarioFBS/config/db.php';
    } catch (Exception $e) {
        // Maneja errores si ocurren dentro de db.php
        echo "<p style='color: red;'>Error al cargar la configuración de la base de datos. Por favor, inténtelo más tarde.</p>";
        error_log("Error al incluir db.php: " . $e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');
    }
} else {
    // Si el archivo no existe, muestra un mensaje amigable
    echo "<p style='color: red;'>No se encontró el archivo de configuración de la base de datos.</p>";
    error_log("Archivo db.php no encontrado.", 3, $_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');
}

// Continuar con el resto del código
if (!isset($_SESSION['conn'])) {
    return "NO ES POSIBLE USAR LA PAGINA";
}
require "views/menu.php";







function traerventasrecientes(){
    ob_start();

    ?>
    <div class="col-md-3">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header text-white d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0">Ventas Recientes</h6>
                            <i class="bi bi-cart4"></i>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Juan Pérez</h6>
                                        <small>Paquete de Detergente 5kg</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">$45</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">María Rodríguez</h6>
                                        <small>Caja de Jabón Líquido (12 unidades)</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">$120</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Carlos Martínez</h6>
                                        <small>Desinfectante Multiusos 1L</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">$10</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Ana Gómez</h6>
                                        <small>Limpiador de Vidrios 750ml</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">$8</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Roberto Sánchez</h6>
                                        <small>Pack de Fregasuelos 5L</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">$25</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center py-3">
                            <a href="<?php echo BASE_URL; ?>/views/ventas.php" class="btn btn-outline-secondary btn-sm">Ver todas las ventas</a>
                        </div>
                    </div>
                </div>
    <?php
     $b = ob_get_clean();
     echo $b;

}

function traerstockbajo(){
    ob_start();

    ?>
<div class="col-md-3">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header text-white d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0">Productos con Stock Bajo</h6>
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Jabón Líquido 1L</h6>
                                        <small>Solo 10 unidades</small>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">Crítico</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Desinfectante 5L</h6>
                                        <small>15 unidades restantes</small>
                                    </div>
                                    <span class="badge bg-warning rounded-pill">Bajo</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Paquete de Esponjas</h6>
                                        <small>20 unidades restantes</small>
                                    </div>
                                    <span class="badge bg-warning rounded-pill">Bajo</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Limpiador de Pisos</h6>
                                        <small>25 unidades restantes</small>
                                    </div>
                                    <span class="badge bg-warning rounded-pill">Bajo</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center py-3">
                            <a href="<?php echo BASE_URL; ?>/views/inventario.php" class="btn btn-outline-warning btn-sm">Ver inventario completo</a>
                        </div>
                    </div>
                </div>

    <?php
     $b = ob_get_clean();
     echo $b;
}

function traerpedidos(){
    ob_start();

    ?>
    <div class="col-md-3">
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header text-white d-flex justify-content-between align-items-center py-3">
                            <h6 class="mb-0">Pedidos en Proceso</h6>
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Pedido #1012</h6>
                                        <small>Hotel Las Palmas</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">En Tránsito</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Pedido #1013</h6>
                                        <small>Restaurante Gourmet</small>
                                    </div>
                                    <span class="badge bg-info rounded-pill">Preparando</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Pedido #1014</h6>
                                        <small>Lavandería La Moderna</small>
                                    </div>
                                    <span class="badge bg-warning rounded-pill">Pendiente</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Pedido #1015</h6>
                                        <small>Hospital Santa Fe</small>
                                    </div>
                                    <span class="badge bg-info rounded-pill">Preparando</span>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center py-3">
                            <a href="<?php echo BASE_URL; ?>/views/pedidos.php" class="btn btn-outline-info btn-sm">Ver todos los pedidos</a>
                        </div>
                    </div>
                </div>
    <?php
     $b = ob_get_clean();
     echo $b;
}





?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Sistema de Gestión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js para gráficos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --bg-dark: #121212;
            --bg-dark-light: #1E1E1E;
            --text-color: #E0E0E0;
            --primary-color: #6200EA;
            --secondary-color: #353535;
            --muted-color: #777777;
            --text-light: #CCCCCC;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-color);
        }

        .card {
            background-color: var(--bg-dark-light) !important;
            color: var(--text-color);
            border: 1px solid #333;
        }

        .card-header {
            background-color: var(--primary-color);
            border-bottom: 1px solid #333;
        }

        .list-group-item {
            background-color: var(--bg-dark-light) !important;
            border-color: #333 !important;
        }

        .list-group-item h6 {
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .list-group-item small {
            color: var(--muted-color);
            font-size: 0.75rem;
        }

        .text-muted {
            color: var(--muted-color) !important;
        }

        .dropdown-menu {
            background-color: var(--bg-dark-light);
        }

        .dropdown-item {
            color: var(--text-color) !important;
        }

        .dropdown-item:hover {
            background-color: rgba(63, 81, 181, 0.2);
        }

        footer {
            height: 150px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación superior -->
    <div id="menu">
        <?php
        echo menu();
        ?>
    </div>

    <!-- Contenido Principal -->
    <div class="container mt-3">
        <div id="main" class="row g-3">

            <div class="row g-3">
                <?php
                traerventasrecientes();
                traerstockbajo();
                traerpedidos();
                ?>
            </div>

        </div>
        <div class="row mt-4 g-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Ventas Semanales</div>
                    <div class="card-body">
                        <canvas id="ventasDiarias"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Top Productos</div>
                    <div class="card-body">
                        <canvas id="productosTop"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>

    </footer>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>


    function traerventasrecientes(){
        
    }
    function traerstockbajo(){

    }
    function traerpedidos(){

    }



        var ventasDiarias = new Chart(document.getElementById('ventasDiarias'), {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [{
                    label: 'Ventas Semanales',
                    data: [12, 19, 3, 5, 2, 3, 10],
                    borderColor: '#3F51B5',
                    backgroundColor: 'rgba(63, 81, 181, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#E0E0E0'
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: '#E0E0E0'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#E0E0E0'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    }
                }
            }
        });

        var productosTop = new Chart(document.getElementById('productosTop'), {
            type: 'bar',
            data: {
                labels: ['Producto A', 'Producto B', 'Producto C'],
                datasets: [{
                    label: 'Ventas por Producto',
                    data: [12, 19, 3],
                    backgroundColor: ['#3F51B5', '#2196F3', '#00BCD4']
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#E0E0E0'
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: '#E0E0E0'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#E0E0E0'
                        },
                        grid: {
                            color: 'rgba(255,255,255,0.1)'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>