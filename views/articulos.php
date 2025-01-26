<?php
session_start();
require "menu.php";

// Function to fetch existing articles
function getArticles() {
    global $conn;
    $query = "SELECT id, nombre, descripcion, size, costo, precio, stock FROM articulos ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to add a new article
function addArticle($nombre, $descripcion, $size, $precio_costo, $precio_venta, $stock) {
    global $conn;
    $query = "INSERT INTO articulos (nombre, descripcion, size, costo, precio, stock) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssddi", $nombre, $descripcion, $size, $precio_costo, $precio_venta, $stock);
    return mysqli_stmt_execute($stmt);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregarArticulo'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $size = $_POST['size'];
    $precio_costo = $_POST['precio_costo'];
    $precio_venta = $_POST['precio_venta'];
    $stock = $_POST['stock'];

    if (addArticle($nombre, $descripcion, $size, $precio_costo, $precio_venta, $stock)) {
        // Redirect to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Artículos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          :root {
    --bg-dark: #121212;
    --bg-dark-light: #1E1E1E;
        --primary-color: #6200EA;
    --text-secondary: #CCCCCC;
    --primary-color: #3F51B5;
    --secondary-color: #2C3E50;
    --accent-color: #2196F3;
    --border-color: #333333;
    --text-color: var(--text-primary); /* Unificar con texto principal */
    --text-light: #CCCCCC;

}
        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .card {
            background-color: var(--bg-dark-light);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
        }

        .table {
            color: var(--text-primary);
        }

        .table thead {
            background-color: var(--secondary-color);
            color: var(--text-primary);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table-striped tbody tr:hover {
            background-color: rgba(63, 81, 181, 0.2);
        }

        .form-label {
            color: var(--text-secondary);
        }

        .form-control {
            background-color: var(--secondary-color);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .form-control:focus {
            background-color: var(--secondary-color);
            color: var(--text-primary);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        footer {
            height: 150px;
        }
    </style>
</head>
<body>
    <div id="menu">
        <?php echo menu(); ?>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Agregar Nuevo Artículo</h5>
                    </div>
                    <div class="card-body">
                        <form id="articleForm" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Artículo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="size" class="form-label">Tamaño (Litros)</label>
                                    <input type="text" class="form-control" id="size" name="size">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_costo" class="form-label">Precio Costo</label>
                                    <input type="number" step="0.01" class="form-control" id="precio_costo" name="precio_costo" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="precio_venta" class="form-label">Precio Venta</label>
                                    <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock" name="stock" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100" name="agregarArticulo">Agregar Artículo</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Artículos Registrados</h5>
                        <span class="badge bg-secondary"><?php echo count(getArticles()); ?> Artículos</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Tamaño</th>
                                        <th>P. Costo</th>
                                        <th>P. Venta</th>
                                        <th>Stock</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $articulos = getArticles();
                                    $i=1;
                                    foreach ($articulos as $articulo):
                                    ?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo htmlspecialchars($articulo['nombre']); ?></td>
                                            <td><?php echo htmlspecialchars($articulo['descripcion']); ?></td>
                                            <td><?php echo htmlspecialchars($articulo['size']); ?></td>
                                            <td>COP<?php echo number_format($articulo['costo'], 2); ?></td>
                                            <td>COP<?php echo number_format($articulo['precio'], 2); ?></td>
                                            <td><?php echo htmlspecialchars($articulo['stock']); ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="#" class="btn btn-outline-primary">Editar</a>
                                                    <a href="#" class="btn btn-outline-danger">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre');
            const precio_venta = document.getElementById('precio_venta');
            const stock = document.getElementById('stock');

            let isValid = true;

            if (nombre.value.trim() === '') {
                nombre.classList.add('is-invalid');
                isValid = false;
            }

            if (precio_venta.value <= 0) {
                precio_venta.classList.add('is-invalid');
                isValid = false;
            }

            if (stock.value < 0) {
                stock.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>