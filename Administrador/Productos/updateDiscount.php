<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logeado y si tiene el rol adecuado
if (!isset($_SESSION['idusuario']) || ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 3)) {
    // Redirigir al login o a una página de acceso no autorizado
    header("Location: ../../pages/login.html");
    exit();
}
require '../../includes/conexion.php';

if (isset($_POST['idproducto'])) {
    $idproducto = $_POST['idproducto'];
    
    // Obtener el precio original del producto
    $sql = "SELECT preciooriginal FROM producto WHERE idproducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idproducto);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();
    
    if ($producto) {
        $preciooriginal = $producto['preciooriginal'];

        // Actualizar el producto, poner descuento a 0 y precio con descuento igual al precio original
        $sql_update = "UPDATE producto SET porcentajedescuento = 0, preciodescuento = ? WHERE idproducto = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("di", $preciooriginal, $idproducto);
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
