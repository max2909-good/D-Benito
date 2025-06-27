<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../includes/conexion.php';
echo '<link rel="stylesheet" href="../assets/css/estilosLista.css">'; // <<--- AQUÍ ENLAZAS TU CSS
echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">';
if (!isset($_SESSION['idusuario'])) {
    echo "Debe iniciar sesión para ver el carrito.";
    exit;
}

$idusuario = $_SESSION['idusuario'];

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

// Mostrar productos
$sql_productos = "SELECT dp.idproducto, dp.cantidad, p.nombreproducto, p.enlace, p.preciodescuento, p.cantidad AS stock_producto FROM detallespedido dp JOIN producto p ON dp.idproducto = p.idproducto WHERE dp.idpedido = ?";
$stmt_productos = $conn->prepare($sql_productos);
$stmt_productos->bind_param("i", $idpedido);
$stmt_productos->execute();
$result_productos = $stmt_productos->get_result();

$total_precio = 0;

echo '<div class="container"><div class="row">';

// Columna de productos (4 columnas)
echo "
<div class='col-md-5'>";
while ($producto = $result_productos->fetch_assoc()) {
    $subtotal = $producto['preciodescuento'] * $producto['cantidad'];
    $total_precio += $subtotal;

    echo "<br>
    <div class='card-product'>
        <div class='btn-remove-wrapper'>
            <form method='post' action='carrito.php' class='form-eliminar'>
                <input type='hidden' name='idproducto' value='{$producto['idproducto']}'>
                <button type='button' class='btn-remove'>🗑</button>
            </form>
        </div>
        <div class='container-img'>
            <img src='{$producto['enlace']}' alt='{$producto['nombreproducto']}' width='80'>
        </div>
        <div class='content-card-product'>
            <h3>{$producto['nombreproducto']}</h3>
            <p>Precio: S/. {$producto['preciodescuento']}</p>

            <form onsubmit='return false;' class='form-cantidad'>
                <label for='cantidad_{$producto['idproducto']}'>Cantidad:</label>
                <input 
                    type='number' 
                    id='cantidad_{$producto['idproducto']}'
                    min='1' 
                    max='{$producto['stock_producto']}' 
                    value='{$producto['cantidad']}' 
                    onchange='validarYActualizarCantidad({$producto['idproducto']}, this)' 
                />
            </form>

            <p>Subtotal: S/. {$subtotal}</p>
        </div>
    </div>";
}
echo "</div>"; 

// Columna de resumen (8 columnas)
echo "<div class='col-md-7'>";
echo "
<div class='cart-summary-modern'>
    <h2><i class='fas fa-shopping-cart'></i> Resumen del Carrito</h2>
    <div class='summary-item'>
        <span>Total de productos:</span>
        <strong>{$total_productos}</strong>
    </div>
    <div class='summary-item'>
        <span>Total a pagar:</span>
        <strong>S/. {$total_precio}</strong>
    </div>
    <form method='post' action='carrito.php'>
        <button type='submit' class='btn-realizar-pedido' name='realizar_pedido'>
            <i class='fas fa-check-circle'></i> Realizar pedido
        </button>
    </form>
    <a href='../pages/Pedido.php' class='view-orders-button'>
        <i class='fas fa-receipt'></i> Ver Pedidos
    </a>
</div>";
echo "</div>"; // Cierra col-md-8

echo '</div></div>'; // Cierra row y container


// Realizar pedido
if (isset($_POST['realizar_pedido'])) {
    date_default_timezone_set('America/Lima');
    $fecha = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("UPDATE pedido SET total = ?, estado = 1, fecha = ? WHERE idpedido = ?");
    $stmt->bind_param("dsi", $total_precio, $fecha, $idpedido);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE producto p JOIN detallespedido dp ON p.idproducto = dp.idproducto SET p.cantidad = p.cantidad - dp.cantidad WHERE dp.idpedido = ?");
    $stmt->bind_param("i", $idpedido);
    $stmt->execute();

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

    $stmt = $conn->prepare("INSERT INTO pedido (idusuario, estado) VALUES (?, 0)");
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();

    echo '<meta http-equiv="refresh" content="0">';
    exit;
}

$conn->close();
?>

<!-- Modal Eliminar -->
<div class="modal-overlay" id="modalEliminar">
  <div class="modal-box">
    <h2>¿Eliminar producto?</h2>
    <p>¿Estás seguro de que deseas eliminar este producto del carrito?</p>
    <div class="modal-buttons">
      <button class="btn-modal-confirm" id="btnConfirmarEliminar">Sí, eliminar</button>
      <button class="btn-modal-cancel" id="btnCancelarEliminar">Cancelar</button>
    </div>
  </div>
</div>

<!-- JavaScript -->
<script>
let productoAEliminar = null;

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".form-eliminar .btn-remove").forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            productoAEliminar = btn.closest("form");
            document.getElementById("modalEliminar").style.display = "flex";
        });
    });

    document.getElementById("btnCancelarEliminar").addEventListener("click", () => {
        document.getElementById("modalEliminar").style.display = "none";
        productoAEliminar = null;
    });

    document.getElementById("btnConfirmarEliminar").addEventListener("click", () => {
        if (productoAEliminar) {
            const hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "eliminar_producto";
            hiddenInput.value = "1";
            productoAEliminar.appendChild(hiddenInput);
            productoAEliminar.submit();
        }
    });
});

function validarYActualizarCantidad(idproducto, inputElement) {
    const valor = parseInt(inputElement.value);
    const max = parseInt(inputElement.max);
    const min = parseInt(inputElement.min);

    if (isNaN(valor) || valor < min || valor > max) {
        alert(`La cantidad debe estar entre ${min} y ${max}.`);
        inputElement.value = min;
        return;
    }

    fetch('carrito.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `actualizar_cantidad=1&idproducto=${idproducto}&nueva_cantidad=${valor}`
    })
    .then(() => location.reload())
    .catch(error => console.error('Error:', error));
}
</script>
