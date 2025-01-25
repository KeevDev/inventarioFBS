<?php
// require_once 'vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Variables de entorno
$host = $_SERVER['DB_HOST'];
$db = $_SERVER['DB_NAME'];
$user = $_SERVER['DB_USER'];
$pass = $_SERVER['DB_PASS'];

try {
    // Crear conexión
    $conn = new mysqli($host, $user, $pass, $db);

    // Verificar si hubo un error en la conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }

    // Guardar conexión en sesión si es exitosa
    $_SESSION['conn'] = $conn;
    
    // Mensaje opcional de éxito
    // echo "Conexión exitosa!";
} catch (Exception $e) {
    // Mostrar un mensaje de error sin detener la página
    echo "<p style='color: red;'>No se pudo conectar a la base de datos. Por favor, inténtelo más tarde.</p>";
    
    // Registrar el error para depuración (archivo o logs del servidor)
    error_log($e->getMessage(), 3, $_SERVER['DOCUMENT_ROOT'] . '/logs/error.log');
}

// Continuar con el resto del código
?>
