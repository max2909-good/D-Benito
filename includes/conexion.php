<?php
// db_connection.php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "administrador";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación de la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
