<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idusuario']) || ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 3)) {
    header("Location: ../../pages/login.html");
    exit();
}

require '../../includes/conexion.php';

if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    echo "ID de producto inválido.";
    exit();
}

$idproducto = (int) $_POST['id'];

// Verificar si el producto existe
$check = $conn->prepare("SELECT idproducto FROM producto WHERE idproducto = ?");
$check->bind_param("i", $idproducto);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {
    echo "El producto no existe.";
    $check->close();
    exit();
}
$check->close();

// Eliminar producto
$stmt = $conn->prepare("DELETE FROM producto WHERE idproducto = ?");
$stmt->bind_param("i", $idproducto);

if ($stmt->execute()) {
    echo "Producto eliminado exitosamente.";
} else {
    echo "Error al eliminar el producto.";
}
$stmt->close();
$conn->close();
?>
