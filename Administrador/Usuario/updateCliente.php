<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verificar si el usuario está logeado y si tiene el rol adecuado
if (!isset($_SESSION['idusuario']) || $_SESSION['idrol'] != 1) {
    // Redirigir al login o a una página de acceso no autorizado
    header("Location: ../../pages/login.html");
    exit();
}
require '../../includes/conexion.php';

if (isset($_POST['idusuario'])) {
    $idusuario = $_POST['idusuario'];
    
    // Obtener el precio original del producto
    $sql = "SELECT*FROM usuario WHERE idusuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    
    if ($usuario) {
        // Actualizar el producto, poner descuento a 0 y precio con descuento igual al precio original
        $sql_update = "UPDATE usuario SET idrol = 2 WHERE idusuario = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $idusuario);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            echo 'success';  // Confirmación de que se actualizó correctamente
        } else {
            echo 'error';  // Error si no se actualizó correctamente
        }
    } else {
        echo 'error';  // Si no se encuentra el producto
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error';  // Si no se recibe el ID del producto
}
?>
