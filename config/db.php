<?php
// require_once 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = $_SERVER['DB_HOST'];
$db =  $_SERVER['DB_NAME']; 
$user =  $_SERVER['DB_USER']; 
$pass =  $_SERVER['DB_PASS']; 


$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$_SESSION['conn'] = $conn;

// echo "Conexión exitosa!";
?>
