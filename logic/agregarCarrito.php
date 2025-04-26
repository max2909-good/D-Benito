<?php
session_start();  // Asegúrate de que la sesión esté iniciada

// Verificar si el usuario está logueado
if (!isset($_SESSION['idusuario'])) {
    echo "Debe iniciar sesión primero.";
    exit;
}

$idusuario = $_SESSION['idusuario'];  // Obtener el ID del usuario logueado
$idproducto = $_POST['idproducto'];  // Obtener el ID del producto desde el frontend

// Comprobar que el ID del producto es válido
if (!$idproducto) {
    echo "Error: No se recibió el ID del producto.";
    exit;
}

require '../includes/conexion.php';

// Obtener el ID del pedido pendiente con estado 0
$sql = "SELECT idpedido, totalproductos FROM pedido WHERE idusuario = ? AND estado = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$stmt->bind_result($idpedido, $totalproductos);
$stmt->fetch();

// Verifica si el pedido existe
if (!$idpedido) {
    echo "No tienes un pedido pendiente.";
    $stmt->close();
    exit;
}
$stmt->close(); // Cierra el primer statement

// Verificar si el producto ya está en el carrito
$sql = "SELECT idproducto FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $idpedido, $idproducto);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Si el producto ya está en el carrito, actualizar la cantidad
    $sql = "UPDATE detallespedido SET cantidad = cantidad + 1 WHERE idpedido = ? AND idproducto = ?";
    $stmt->close();  // Cierra el statement anterior
    $stmt = $conn->prepare($sql);  // Crea un nuevo statement para la actualización
    $stmt->bind_param("ii", $idpedido, $idproducto);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Actualizar total de productos en la tabla pedido
        $totalproductos++;
        $sql = "UPDATE pedido SET totalproductos = ? WHERE idpedido = ?";
        $stmt->close();  // Cierra el statement anterior
        $stmt = $conn->prepare($sql);  // Crea un nuevo statement para la actualización del total de productos
        $stmt->bind_param("ii", $totalproductos, $idpedido);
        $stmt->execute();

        echo "Producto actualizado en el carrito.";
    } else {
        echo "Error al actualizar el producto en el carrito.";
    }
} else {
    // Si el producto no está en el carrito, insertarlo
    $sql = "INSERT INTO detallespedido (idpedido, idproducto, cantidad) VALUES (?, ?, ?)";
    $stmt->close();  // Cierra el statement anterior
    $stmt = $conn->prepare($sql);  // Crea un nuevo statement para la inserción
    
    // Define la variable 'cantidad' antes de pasarla a bind_param
    $cantidad = 1;  // Establecer la cantidad a 1
    $stmt->bind_param("iii", $idpedido, $idproducto, $cantidad);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Actualizar total de productos en la tabla pedido
        $totalproductos++;
        $sql = "UPDATE pedido SET totalproductos = ? WHERE idpedido = ?";
        $stmt->close();  // Cierra el statement anterior
        $stmt = $conn->prepare($sql);  // Crea un nuevo statement para la actualización del total de productos
        $stmt->bind_param("ii", $totalproductos, $idpedido);
        $stmt->execute();

        echo "Producto añadido al carrito correctamente.";
    } else {
        echo "Error al añadir el producto al carrito.";
    }
}

$stmt->close();  // Cierra el último statement
$conn->close();  // Cierra la conexión
?>
