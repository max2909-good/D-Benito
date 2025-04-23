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
    $idproducto = $_POST['idproducto'];
    $idcategoria = $_POST['idcategoria'];
    $idproveedor = $_POST['idproveedor'];
    $nombreproducto = $_POST['nombreproducto'];
    $enlace = $_POST['enlace'];
    $preciooriginal = $_POST['preciooriginal'];
    $porcentajedescuento = isset($_POST['editarporcentajedescuento']) ? $_POST['editarporcentajedescuento'] : NULL;
    $preciodescuento = isset($_POST['editarpreciodescuento']) ? $_POST['editarpreciodescuento'] : NULL;
    $calificacion = $_POST['calificacion'];
    $cantidad = $_POST['cantidad'];

    // Preparar la consulta
    $stmt = $conn->prepare("UPDATE producto SET idcategoria = ?, idproveedor = ?, nombreproducto = ?, enlace = ?, preciooriginal = ?, porcentajedescuento = ?, preciodescuento = ?, calificacion = ?, cantidad = ? WHERE idproducto = ?");

    if ($stmt) {
        // Bind de parámetros: 'i' para enteros, 's' para cadenas, 'd' para decimales
        $stmt->bind_param(
            "iissdddiii",
            $idcategoria,
            $idproveedor,
            $nombreproducto,
            $enlace,
            $preciooriginal,
            $porcentajedescuento,
            $preciodescuento,
            $calificacion,
            $cantidad,
            $idproducto
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