<?php
// session_start(); 
require_once './config/db.php';
if (isset($_SESSION['conn'])){

}
// require "views/menu.php";




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
        --primary-color-light: #9D47F3;
        --secondary-color: #03DAC6;
        --danger-color: #B00020;
        --card-bg: #1E1E1E;
        --btn-bg: #6200EA;
        --btn-hover-bg: #3700B3;
        --input-bg: #333333;
        --input-border: #444444;
        --input-focus-border: #03DAC6;
        --table-border: #444444;
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
            background-color: rgba(63, 81, 181, 0.2);
            border-bottom: 1px solid #333;
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
    </div>

    <!-- Contenido Principal -->
    <div class="container mt-3">
        <div id="main" class="row g-3">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Ventas Recientes
                        <i class="bi bi-cart4 text-success"></i>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Juan Pérez</strong>
                                    <small class="d-block text-secondary">Laptop Dell</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$1,200</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>María Rodríguez</strong>
                                    <small class="d-block text-secondary">Monitor LG 24"</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$250</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Carlos Martínez</strong>
                                    <small class="d-block text-secondary">Teclado Mecánico</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$120</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Ana Gómez</strong>
                                    <small class="d-block text-secondary">Mouse Inalámbrico</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$50</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Roberto Sánchez</strong>
                                    <small class="d-block text-secondary">Impresora Multifuncional</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$350</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="text-decoration-none">Ver todas las ventas</a>
                    </div>
                </div>
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