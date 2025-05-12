<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['idusuario']) || ($_SESSION['idrol'] != 1 && $_SESSION['idrol'] != 3)) {
    header("Location: ../../pages/login.html");
    exit();
}

require '../../includes/conexion.php';

$mensajeError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idcategoria = filter_input(INPUT_POST, 'idcategoria', FILTER_VALIDATE_INT);
    $idproveedor = filter_input(INPUT_POST, 'idproveedor', FILTER_VALIDATE_INT);
    $nombreproducto = trim($_POST['nombreproducto']);
    $enlace = filter_var(trim($_POST['enlace']), FILTER_SANITIZE_URL);
    $preciooriginal = filter_input(INPUT_POST, 'preciooriginal', FILTER_VALIDATE_FLOAT);
    $porcentajedescuento = isset($_POST['porcentajedescuento']) ? filter_input(INPUT_POST, 'porcentajedescuento', FILTER_VALIDATE_FLOAT) : NULL;
    $preciodescuento = isset($_POST['preciodescuento']) ? filter_input(INPUT_POST, 'preciodescuento', FILTER_VALIDATE_FLOAT) : NULL;
    $calificacion = filter_input(INPUT_POST, 'calificacion', FILTER_VALIDATE_INT);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_VALIDATE_INT);

    // Validar nombre
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $nombreproducto)) {
        echo  "⚠️ El nombre del producto solo debe contener letras y espacios.";
    } else {
        $stmt = $conn->prepare("INSERT INTO producto (idcategoria, idproveedor, nombreproducto, enlace, preciooriginal, porcentajedescuento, preciodescuento, calificacion, cantidad) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param(
                "iissdddii",
                $idcategoria,
                $idproveedor,
                $nombreproducto,
                $enlace,
                $preciooriginal,
                $porcentajedescuento,
                $preciodescuento,
                $calificacion,
                $cantidad
            );

            if ($stmt->execute()) {
                echo  "✅ Producto agregado exitosamente.";
            } else {
                echo  "❌ Error al agregar el producto: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "❌ Error en la preparación de la consulta: " . $conn->error;
        }
    }

    $conn->close();
}
?>

