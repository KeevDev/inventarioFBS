<?php
session_start(); 
require "menu.php"; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';





function ventaproducto(){
    ?>
    <!-- Buscar Producto y Lista de Productos -->
    <div class="col-md-8">
        <h3 class="mb-3">Buscar Productos</h3>
        <input type="text" id="search-product" class="form-control" placeholder="Buscar por nombre, código o categoría">
        
        <h5 class="mt-4">Productos Disponibles</h5>
        <div class="row" id="product-list">
            <!-- Productos dinámicos se agregarán aquí -->
            <div class="col-md-4 product-card" onclick="addToCart('Producto 1', 100)">
                <div class="card">
                    <img src="producto1.jpg" class="card-img-top" alt="Producto 1">
                    <div class="card-body">
                        <h5 class="card-title">Producto 1</h5>
                        <p class="card-text">Descripción breve del producto.</p>
                        <p class="text-warning">Precio: $100</p>
                    </div>
                </div>
            </div>
            <!-- Producto 2 -->
            <div class="col-md-4 product-card" onclick="addToCart('Producto 2', 150)">
                <div class="card">
                    <img src="producto2.jpg" class="card-img-top" alt="Producto 2">
                    <div class="card-body">
                        <h5 class="card-title">Producto 2</h5>
                        <p class="card-text">Descripción breve del producto.</p>
                        <p class="text-warning">Precio: $150</p>
                    </div>
                </div>
            </div>
            <!-- Producto 3 -->
            <div class="col-md-4 product-card" onclick="addToCart('Producto 3', 200)">
                <div class="card">
                    <img src="producto3.jpg" class="card-img-top" alt="Producto 3">
                    <div class="card-body">
                        <h5 class="card-title">Producto 3</h5>
                        <p class="card-text">Descripción breve del producto.</p>
                        <p class="text-warning">Precio: $200</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Carrito de Compras y Resumen de Factura -->
    <div class="col-md-4">
        <h3 class="mb-3">Carrito de Compras</h3>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Resumen de la Venta</h5>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Los productos seleccionados aparecerán aquí -->
                    </tbody>
                </table>

                <!-- Resumen de Totales -->
                <div class="d-flex justify-content-between">
                    <p><strong>Total: </strong></p>
                    <p id="total-price">$0</p>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="finalizeSale()">Realizar Venta</button>
                    <button class="btn btn-secondary" onclick="clearCart()">Limpiar Carrito</button>
                </div>
            </div>
        </div>
    </div>
    <?php
}





?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facturación - Sistema de Gestión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos Personalizados -->
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
        font-family: 'Arial', sans-serif;
    }

    .navbar {
        background-color: var(--bg-dark-light) !important;
        border-bottom: 2px solid var(--primary-color);
    }

    .nav-link {
        color: var(--text-color) !important;
        font-weight: 500;
    }

    .nav-link:hover {
        color: var(--secondary-color) !important;
    }

    .sidebar-offcanvas {
        width: 270px;
        background-color: var(--bg-dark-light) !important;
    }

    .card {
        background-color: var(--card-bg);
        border: 1px solid var(--primary-color);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        color: var(--text-color);
        font-size: 1.25rem;
        font-weight: 600;
    }

    .card-text {
        color: var(--text-color);
        font-size: 1rem;
    }

    .product-card {
        cursor: pointer;
        transition: transform 0.3s ease, background-color 0.3s ease;
        border-radius: 8px;
    }

    .product-card:hover {
        transform: translateY(-5px);
        background-color: var(--bg-dark);
    }

    .product-card img {
        border-radius: 8px;
        transition: opacity 0.3s ease;
    }

    .product-card:hover img {
        opacity: 0.8;
    }

    .btn-primary, .btn-secondary {
        background-color: var(--btn-bg);
        border-color: var(--btn-bg);
        font-weight: 600;
    }

    .btn-primary:hover, .btn-secondary:hover {
        background-color: var(--btn-hover-bg);
        border-color: var(--btn-hover-bg);
    }

    .btn-secondary {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-secondary:hover {
        background-color: #018786;
        border-color: #018786;
    }

    .input-group .form-control {
        background-color: var(--input-bg);
        border: 1px solid var(--input-border);
        color: var(--text-color);
        border-radius: 8px;
    }

    .input-group .form-control:focus {
        border-color: var(--input-focus-border);
        box-shadow: 0 0 0 0.25rem rgba(3, 218, 198, 0.25);
    }

    .table {
        background-color: #222222;
        border-radius: 8px;
        border: 1px solid var(--table-border);
        margin-bottom: 20px;
    }

    .table thead {
        background-color: var(--bg-dark-light);
    }

    .table th, .table td {
        color: var(--text-color);
        padding: 10px;
        vertical-align: middle;
        text-align: center;
    }

    .cart-item {
        border-bottom: 1px solid #444444;
    }

    .footer {
        background-color: var(--bg-dark-light);
        color: var(--text-color);
        padding: 20px;
        text-align: center;
    }

    .footer a {
        color: var(--secondary-color);
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .d-grid .btn {
        border-radius: 8px;
    }
</style>

</head>

<body>
    <!-- Barra de navegación superior -->
    <div id="menu">
        <?php echo menu() ?>
    </div>

    <!-- Contenido Principal -->
    <div class="container mt-3">
    <div id="main" class="row g-3">
        <!-- Tarjetas para Vender, Ventas Recientes y Historial de Ventas -->
        <div class="col-md-4">
            <!-- Tarjeta para Vender Producto -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vender Producto</h5>
                    <p class="card-text">Agrega productos al carrito y realiza la venta.</p>
                    <button class="btn btn-primary" onclick="window.location.href='#'">Vender</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Tarjeta de Ventas Recientes -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ventas Recientes</h5>
                    <p class="card-text">Consulta las ventas más recientes realizadas.</p>
                    <button class="btn btn-secondary" onclick="window.location.href='#'">Ver Ventas Recientes</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Tarjeta de Historial de Ventas -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Historial de Ventas</h5>
                    <p class="card-text">Accede al historial completo de todas las ventas.</p>
                    <button class="btn btn-secondary" onclick="window.location.href='#'">Ver Historial</button>
                </div>
            </div>
        </div>
    </div>

    
</div>


    <footer>
        <!-- Aquí va el pie de página -->
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let cart = [];
        let total = 0;

        // Función para agregar productos al carrito
        const addToCart = (productName, price) => {
            cart.push({ name: productName, price: price, quantity: 1 });
            updateCart();
        };

        // Función para actualizar el carrito y el total
        const updateCart = () => {
            let cartItems = document.getElementById("cart-items");
            cartItems.innerHTML = ""; // Limpiar carrito actual
            total = 0;

            // Agregar productos al carrito
            cart.forEach(item => {
                let subtotal = item.price * item.quantity;
                total += subtotal;
                cartItems.innerHTML += `
                    <tr class="cart-item">
                        <td>${item.name}</td>
                        <td>${item.quantity}</td>
                        <td>$${subtotal}</td>
                    </tr>
                `;
            });

            // Actualizar precio total
            document.getElementById("total-price").innerText = `$${total}`;
        };

        // Función para finalizar la venta
        const finalizeSale = () => {
            if (cart.length === 0) {
                alert("El carrito está vacío.");
                return;
            }
            alert("Venta realizada con éxito.");
            cart = []; // Limpiar carrito después de la venta
            updateCart();
        };

        // Función para limpiar el carrito
        const clearCart = () => {
            cart = [];
            updateCart();
        };
    </script>
</body>

</html>
