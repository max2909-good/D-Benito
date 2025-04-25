<?php
session_start();  // Asegúrate de que la sesión esté iniciada

// Verificar si el usuario está logueado
if (!isset($_SESSION['idusuario'])) {
    echo "0";  // Si no está logueado, el carrito está vacío
    exit;
}

$idusuario = $_SESSION['idusuario'];  // Obtener el ID del usuario logueado

require '../includes/conexion.php';

// Obtener el total de productos en el carrito
$sql = "SELECT totalproductos FROM pedido WHERE idusuario = ? AND estado = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$stmt->bind_result($totalproductos);
$stmt->fetch();

// Si no hay pedido, retornar 0
if (!$totalproductos) {
    echo "0";
} else {
    echo $totalproductos;  // Devolver el número total de productos en el carrito
}

$stmt->close();
$conn->close();
?>
