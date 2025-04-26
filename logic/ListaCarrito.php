<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../includes/conexion.php'; // Incluye la conexión a la base de datos

// Verifica que el usuario ha iniciado sesión
if (!isset($_SESSION['idusuario'])) {
    echo "Debe iniciar sesión para ver el carrito.";
    exit;
}

$idusuario = $_SESSION['idusuario'];

// Obtener el pedido activo (estado 0) para el usuario actual
$sql_pedido = "SELECT idpedido, totalproductos FROM pedido WHERE idusuario = ? AND estado = 0";
$stmt_pedido = $conn->prepare($sql_pedido);
$stmt_pedido->bind_param("i", $idusuario);
$stmt_pedido->execute();
$result_pedido = $stmt_pedido->get_result();
$pedido = $result_pedido->fetch_assoc();

// Si no hay pedido o el total de productos es 0, muestra el mensaje y el enlace "Ver Pedidos"
if (!$pedido || $pedido['totalproductos'] == 0) {
    echo "No hay productos en el carrito.
 <br>
    <a href='../pages/Pedido.php' class='view-orders-button'>Ver Pedidos</a>
";

}else{


$idpedido = $pedido['idpedido'];
$total_productos = $pedido['totalproductos'];
// Obtener los productos en el carrito del usuario
$sql_productos = "SELECT dp.idproducto, dp.cantidad, p.nombreproducto, p.enlace, p.preciodescuento, p.cantidad AS stock_producto, pe.totalproductos
FROM detallespedido dp 
JOIN producto p ON dp.idproducto = p.idproducto
JOIN pedido pe ON dp.idpedido = pe.idpedido
WHERE dp.idpedido = ?";
$stmt_productos = $conn->prepare($sql_productos);
$stmt_productos->bind_param("i", $idpedido);
$stmt_productos->execute();
$result_productos = $stmt_productos->get_result();

$total_precio = 0;

    // Mostrar los productos en el carrito
    while ($producto = $result_productos->fetch_assoc()) {
        if (($producto['stock_producto'] == 0)) {
            // Eliminar el producto del carrito si la cantidad es 0
            $sql_delete_producto = "DELETE FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
            $stmt_delete_producto = $conn->prepare($sql_delete_producto);
            $stmt_delete_producto->bind_param("ii", $idpedido, $producto['idproducto']);
            $stmt_delete_producto->execute();

            // Actualizar el total de productos en pedido después de eliminar el producto
            $sql_total_productos = "UPDATE pedido SET totalproductos = totalproductos - ? WHERE idpedido = ?";
            $stmt_total_productos = $conn->prepare($sql_total_productos);
            $stmt_total_productos->bind_param("ii", $producto['cantidad'],$idpedido);
            $stmt_total_productos->execute();
            echo '<meta http-equiv="refresh" content="1">';
        }
        if ($producto['cantidad'] > $producto['stock_producto']) {
            // Si la cantidad es mayor que el stock, actualizar la cantidad en detallespedido
            $nueva_cantidad = $producto['stock_producto'];
            $sql_update_cantidad = "UPDATE detallespedido SET cantidad = ? WHERE idpedido = ? AND idproducto = ?";
            $stmt_update_cantidad = $conn->prepare($sql_update_cantidad);
            $stmt_update_cantidad->bind_param("iii", $nueva_cantidad, $idpedido, $producto['idproducto']);
            $stmt_update_cantidad->execute();
            $nuevo_cantidad_productos= $producto['totalproductos']-($producto['cantidad'] - $nueva_cantidad);
            // Actualizar total de productos en pedido
            $sql_total_productos = "UPDATE pedido SET totalproductos =? WHERE idpedido = ?";
            $stmt_total_productos = $conn->prepare($sql_total_productos);
            $stmt_total_productos->bind_param("ii", $nuevo_cantidad_productos, $idpedido);
            $stmt_total_productos->execute();
            echo '<meta http-equiv="refresh" content="1">';
        }
      

        $subtotal = $producto['preciodescuento'] * $producto['cantidad'];
        $total_precio += $subtotal;

        echo "
    <div class='card-product'>
        <div class='container-img'>
            <img src='{$producto['enlace']}' alt='{$producto['nombreproducto']}'>
        </div>
        <div class='content-card-product'>
            <h3>{$producto['nombreproducto']}</h3>
            <p>Precio: S/{$producto['preciodescuento']}</p>
            <p>Cantidad: {$producto['cantidad']}</p>
            <form method='post' action='carrito.php'>
                <input type='hidden' name='idproducto' value='{$producto['idproducto']}'>
                <label for='cantidad_eliminar'>Cantidad a eliminar:</label>
                <select name='cantidad_eliminar'>";

        for ($i = $producto['cantidad']; $i >= 1; $i--) {
            echo "<option value='$i'>$i</option>";
        }

        echo "</select>
                <button type='submit' class='btn-remove' name='eliminar_producto'>Eliminar</button>
            </form>
            <p>Subtotal: S/{$subtotal}</p>
        </div>
    </div>";
    }

    // Resumen del carrito
    echo "
<div class='cart-summary'>
    <p class='order-summary-title'>Resumen del Carrito</p>
    <p>Total de productos en el carrito: {$total_productos}</p>
    <p>Suma total de productos: S/{$total_precio}</p>
    <form method='post' action='carrito.php'>
        <button type='submit' class='btn-realizar-pedido' name='realizar_pedido'>Realizar pedido</button>
    </form>
    <a href='../pages/Pedido.php' class='view-orders-button'>Ver Pedidos</a>
</div>";
}
// Procesar eliminación de producto del carrito
if (isset($_POST['eliminar_producto'])) {
    $idproducto = $_POST['idproducto'];
    $cantidad_eliminar = $_POST['cantidad_eliminar'];
    // Obtener la cantidad actual en detallespedido para el producto
    $sql_get_cantidad = "SELECT cantidad FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
    $stmt_get_cantidad = $conn->prepare($sql_get_cantidad);
    $stmt_get_cantidad->bind_param("ii", $idpedido, $idproducto);
    $stmt_get_cantidad->execute();
    $result_cantidad = $stmt_get_cantidad->get_result();
    $producto = $result_cantidad->fetch_assoc();
    $cantidad_actual = $producto['cantidad'];
    // Si la cantidad a eliminar es igual a la cantidad actual, eliminar el producto de detallespedido
    if ($cantidad_eliminar >= $cantidad_actual) {
        // Eliminar producto de detallespedido
        $sql_delete_producto = "DELETE FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
        $stmt_delete_producto = $conn->prepare($sql_delete_producto);
        $stmt_delete_producto->bind_param("ii", $idpedido, $idproducto);
        $stmt_delete_producto->execute();
        // Actualizar el total de productos en pedido después de eliminar el producto
        $sql_total_productos = "UPDATE pedido SET totalproductos = totalproductos - ? WHERE idpedido = ?";
        $stmt_total_productos = $conn->prepare($sql_total_productos);
        $stmt_total_productos->bind_param("ii", $cantidad_actual, $idpedido);
        $stmt_total_productos->execute();
        echo '<meta http-equiv="refresh" content="1">';
    }else{
    // Actualizar cantidad en detallespedido
    $sql_update = "UPDATE detallespedido SET cantidad = cantidad - ? WHERE idpedido = ? AND idproducto = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("iii", $cantidad_eliminar, $idpedido, $idproducto);
    $stmt_update->execute();

    // Actualizar total de productos en pedido
    $sql_total_productos = "UPDATE pedido SET totalproductos = totalproductos - ? WHERE idpedido = ?";
    $stmt_total_productos = $conn->prepare($sql_total_productos);
    $stmt_total_productos->bind_param("ii", $cantidad_eliminar, $idpedido);
    $stmt_total_productos->execute();

    echo '<meta http-equiv="refresh" content="1">';
    }
}
date_default_timezone_set('America/Lima');
// Procesar la realización del pedido
if (isset($_POST['realizar_pedido'])) {
    $fecha = date("Y-m-d H:i:s");

    // Actualizar el estado del pedido y la fecha
    $sql_realizar_pedido = "UPDATE pedido SET total = ?, estado = 1, fecha = ? WHERE idpedido = ?";
    $stmt_realizar_pedido = $conn->prepare($sql_realizar_pedido);
    $stmt_realizar_pedido->bind_param("dsi", $total_precio, $fecha, $idpedido);
    $stmt_realizar_pedido->execute();

    // Restar cantidades de producto
    $sql_restar_cantidades = "UPDATE producto p 
                              JOIN detallespedido dp ON p.idproducto = dp.idproducto 
                              SET p.cantidad = p.cantidad - dp.cantidad 
                              WHERE dp.idpedido = ?";
    $stmt_restar_cantidades = $conn->prepare($sql_restar_cantidades);
    $stmt_restar_cantidades->bind_param("i", $idpedido);
    $stmt_restar_cantidades->execute();

    // Actualizar los detalles del pedido con la información de producto, categoría y proveedor
    $sql_update_detalles = "
        UPDATE detallespedido dp
        JOIN producto p ON dp.idproducto = p.idproducto
        JOIN categoria c ON p.idcategoria = c.idcategoria
        JOIN proveedor pr ON p.idproveedor = pr.idproveedor
        SET dp.nombreproducto = p.nombreproducto,
            dp.preciooriginal = p.preciooriginal,
            dp.porcentajedescuento = p.porcentajedescuento,
            dp.preciodescuento = p.preciodescuento,
            dp.calificacion = p.calificacion,
            dp.categoria = c.nombrecategoria,
            dp.proveedor = pr.nombreprov
        WHERE dp.idpedido = ?";

    $stmt_update_detalles = $conn->prepare($sql_update_detalles);
    $stmt_update_detalles->bind_param("i", $idpedido);
    $stmt_update_detalles->execute();

    // Crear un nuevo pedido en estado 0 para el mismo usuario
    $sql_nuevo_pedido = "INSERT INTO pedido (idusuario, estado) VALUES (?, 0)";
    $stmt_nuevo_pedido = $conn->prepare($sql_nuevo_pedido);
    $stmt_nuevo_pedido->bind_param("i", $idusuario);
    $stmt_nuevo_pedido->execute();

    echo '<meta http-equiv="refresh" content="1">';
    exit();
}

$conn->close();
