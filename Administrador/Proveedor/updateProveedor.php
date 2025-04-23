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
// tu_script_php.php
require '../../includes/conexion.php';

// Verifica si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $idproveedor = $_POST['idproveedor'];
    $nombreprov = $_POST['nombreprov'];
    $direccionprov = $_POST['direccionprov'];
    $telefonoprov = $_POST['telefonoprov'];
    $emailprov = $_POST['emailprov'];

    // Preparar la consulta
    $stmt = $conn->prepare("UPDATE proveedor SET nombreprov = ?, direccionprov = ?, telefonoprov = ?, emailprov = ? WHERE idproveedor = ?");

    if ($stmt) {
        // Bind de parámetros: 'i' para enteros, 's' para cadenas, 'd' para decimales
        $stmt->bind_param(
            "ssssi",
            $nombreprov,
            $direccionprov,
            $telefonoprov,
            $emailprov,
            $idproveedor
        );

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Producto actualizado exitosamente";
            // Opcional: Redirigir o limpiar el formulario
        } else {
            echo "Error al actualizar el producto: " . $stmt->error;
        }

        // Cerrar el statement
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>