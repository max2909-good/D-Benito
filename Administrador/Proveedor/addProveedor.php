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

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $nombreprov = $_POST['nombreprov'];
    $direccionprov = $_POST['direccionprov'];
    $telefonoprov = $_POST['telefonoprov'];
    $emailprov = $_POST['emailprov'];

    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO proveedor (nombreprov, direccionprov, telefonoprov, emailprov) VALUES (?, ?, ?, ?)");

    if ($stmt) {
        // Bind de parámetros: 'i' para enteros, 's' para cadenas, 'd' para decimales
        $stmt->bind_param(
            "ssss",
            $nombreprov,
            $direccionprov,
            $telefonoprov,
            $emailprov
        );

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Producto agregado exitosamente";
            // Opcional: Redirigir o limpiar el formulario
        } else {
            echo "Error al agregar el producto: " . $stmt->error;
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
