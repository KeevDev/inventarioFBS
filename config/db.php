<?php

$host = '193.203.175.121'; 
$db = 'u925077191_db_fbs'; 
$user = 'u925077191_kev'; 
$pass = 'e#!Ls#;4jt8Z'; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$_SESSION['conn'] = $conn;

// echo "Conexión exitosa!";
?>
