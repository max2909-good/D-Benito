<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../includes/conexion.php';

if (!isset($_SESSION['idusuario'])) {
    echo "Debe iniciar sesión para ver el carrito.";
    exit;
}

$idusuario = $_SESSION['idusuario'];

// Obtener pedido activo
$sql_pedido = "SELECT idpedido, totalproductos FROM pedido WHERE idusuario = ? AND estado = 0";
$stmt_pedido = $conn->prepare($sql_pedido);
$stmt_pedido->bind_param("i", $idusuario);
$stmt_pedido->execute();
$result_pedido = $stmt_pedido->get_result();
$pedido = $result_pedido->fetch_assoc();

if (!$pedido || $pedido['totalproductos'] == 0) {
    echo "No hay productos en el carrito.<br><a href='../pages/Pedido.php' class='view-orders-button'>Ver Pedidos</a>";
    exit;
}

$idpedido = $pedido['idpedido'];
$total_productos = $pedido['totalproductos'];

// Actualizar cantidad
if (isset($_POST['actualizar_cantidad'])) {
    $idproducto = $_POST['idproducto'];
    $nueva_cantidad = intval($_POST['nueva_cantidad']);

    $sql_get = "SELECT cantidad FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
    $stmt = $conn->prepare($sql_get);
    $stmt->bind_param("ii", $idpedido, $idproducto);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $cantidad_actual = $data['cantidad'];

    $diferencia = $nueva_cantidad - $cantidad_actual;

    $sql_update = "UPDATE detallespedido SET cantidad = ? WHERE idpedido = ? AND idproducto = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("iii", $nueva_cantidad, $idpedido, $idproducto);
    $stmt->execute();

    $sql_total = "UPDATE pedido SET totalproductos = totalproductos + ? WHERE idpedido = ?";
    $stmt = $conn->prepare($sql_total);
    $stmt->bind_param("ii", $diferencia, $idpedido);
    $stmt->execute();

    exit;
}

// Mostrar productos
$sql_productos = "SELECT dp.idproducto, dp.cantidad, p.nombreproducto, p.enlace, p.preciodescuento, p.cantidad AS stock_producto FROM detallespedido dp JOIN producto p ON dp.idproducto = p.idproducto WHERE dp.idpedido = ?";
$stmt_productos = $conn->prepare($sql_productos);
$stmt_productos->bind_param("i", $idpedido);
$stmt_productos->execute();
$result_productos = $stmt_productos->get_result();

$total_precio = 0;

while ($producto = $result_productos->fetch_assoc()) {
    $subtotal = $producto['preciodescuento'] * $producto['cantidad'];
    $total_precio += $subtotal;

    echo "
    <div class='card-product'>
        <div class='container-img'>
            <img src='{$producto['enlace']}' alt='{$producto['nombreproducto']}' width='80'>
        </div>
        <div class='content-card-product'>
            <h3>{$producto['nombreproducto']}</h3>
            <p>Precio: S/. {$producto['preciodescuento']}</p>
            <label>Cantidad:</label>
            <input 
                type='number' 
                min='1' 
                max='{$producto['stock_producto']}' 
                value='{$producto['cantidad']}' 
                onchange='actualizarCantidad({$producto['idproducto']}, this.value)'>
            <form method='post' action='carrito.php'>
                <input type='hidden' name='idproducto' value='{$producto['idproducto']}'>
                <button type='submit' class='btn-remove' name='eliminar_producto'>Eliminar</button>
            </form>
            <p>Subtotal: S/. {$subtotal}</p>
        </div>
    </div>";
}

echo "<div class='cart-summary'>
    <p class='order-summary-title'>Resumen del Carrito</p>
    <p>Total de productos: {$total_productos}</p>
    <p>Total a pagar: S/. {$total_precio}</p>
    <form method='post' action='carrito.php'>
        <button type='submit' class='btn-realizar-pedido' name='realizar_pedido'>Realizar pedido</button>
    </form>
    <a href='../pages/Pedido.php' class='view-orders-button'>Ver Pedidos</a>
</div>";

// Eliminar producto
if (isset($_POST['eliminar_producto'])) {
    $idproducto = $_POST['idproducto'];
    $sql_get = "SELECT cantidad FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
    $stmt = $conn->prepare($sql_get);
    $stmt->bind_param("ii", $idpedido, $idproducto);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $cantidad_actual = $data['cantidad'];

    $sql_del = "DELETE FROM detallespedido WHERE idpedido = ? AND idproducto = ?";
    $stmt = $conn->prepare($sql_del);
    $stmt->bind_param("ii", $idpedido, $idproducto);
    $stmt->execute();

    $sql_total = "UPDATE pedido SET totalproductos = totalproductos - ? WHERE idpedido = ?";
    $stmt = $conn->prepare($sql_total);
    $stmt->bind_param("ii", $cantidad_actual, $idpedido);
    $stmt->execute();

    echo '<meta http-equiv="refresh" content="0">';
    exit;
}

// Realizar pedido
if (isset($_POST['realizar_pedido'])) {
    date_default_timezone_set('America/Lima');
    $fecha = date("Y-m-d H:i:s");

    // Actualizar estado y total
    $stmt = $conn->prepare("UPDATE pedido SET total = ?, estado = 1, fecha = ? WHERE idpedido = ?");
    $stmt->bind_param("dsi", $total_precio, $fecha, $idpedido);
    $stmt->execute();

    // Restar stock
    $stmt = $conn->prepare("UPDATE producto p JOIN detallespedido dp ON p.idproducto = dp.idproducto SET p.cantidad = p.cantidad - dp.cantidad WHERE dp.idpedido = ?");
    $stmt->bind_param("i", $idpedido);
    $stmt->execute();

    // Guardar datos finales en detallespedido
    $sql_detalle = "UPDATE detallespedido dp
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
    $stmt = $conn->prepare($sql_detalle);
    $stmt->bind_param("i", $idpedido);
    $stmt->execute();

    // Crear nuevo pedido vacío
    $stmt = $conn->prepare("INSERT INTO pedido (idusuario, estado) VALUES (?, 0)");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();

    echo '<meta http-equiv="refresh" content="0">';
    exit;
}

$conn->close();
?>
<script>
function actualizarCantidad(idproducto, nuevaCantidad) {
    fetch('carrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `actualizar_cantidad=1&idproducto=${idproducto}&nueva_cantidad=${nuevaCantidad}`
    })
    .then(response => response.text())
    .then(() => location.reload())
    .catch(error => console.error('Error:', error));
}
</script>
