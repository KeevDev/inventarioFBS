<?php
session_start(); 


require "menu.php"; 
// require_once $_SERVER['DOCUMENT_ROOT'] . '/inventarioFBS/config/db.php';




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
            --primary-color: #3F51B5;
            --secondary-color: #2196F3;
        }


        body {
            background-color: var(--bg-dark);
            color: var(--text-color);
        }

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

        
        footer {
            height: 150px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación superior -->
    <div id="menu">
        <?php echo menu()?>
    </div>

    <!-- Contenido Principal -->
    <div class="container mt-3">
        <div id="main" class="row g-3">
            
            
        </div>
    </div>

    <footer>

    </footer>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
    </script>
</body>

</html>