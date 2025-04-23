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

$id = isset($_GET['id']) ? $_GET['id'] : '';  // Obtener el id del producto

if ($id) {
    // Consultar los datos del producto
    $sql = "SELECT p.*, c.nombrecategoria, pr.nombreprov 
            FROM producto p 
            JOIN categoria c ON p.idcategoria = c.idcategoria 
            JOIN proveedor pr ON p.idproveedor = pr.idproveedor 
            WHERE p.idproducto = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el producto se encuentra
    if ($row = $result->fetch_assoc()) {
        // Convertir los datos del producto a formato JSON
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Producto no encontrado']);
    }

    $stmt->close();
}

$conn->close();
?>
