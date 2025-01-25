<?php

$host = ''; 
$db = ''; 
$user = ''; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$_SESSION['conn'] = $conn;

// echo "Conexión exitosa!";
?>
