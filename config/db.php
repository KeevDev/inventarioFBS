<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inventarioFBS/vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/inventarioFBS');
$dotenv->load();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = getenv('DB_HOST');
$db = getenv('DB_NAME'); 
$user = getenv('DB_USER'); 
$pass = getenv('DB_PASS'); 


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$_SESSION['conn'] = $conn;

echo "Conexión exitosa!";
?>
