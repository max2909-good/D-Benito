<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../includes/conexion.php';

// Verifica que el usuario ha iniciado sesión
if (!isset($_SESSION['idusuario'])) {
    echo "Debe iniciar sesión para ver sus pedidos.";
    exit;
}
$idusuario = $_SESSION['idusuario'];

// Consulta para obtener pedidos con estado 1, 2, 3 y sus respectivos productos
$sql = "
    SELECT 
        p.idpedido,
        p.total,
        p.estado,
        p.fecha,
        dp.nombreproducto,
        dp.preciooriginal,
        dp.porcentajedescuento,
        dp.preciodescuento,
        dp.cantidad AS cantidad_producto
    FROM 
        pedido p
    INNER JOIN 
        detallespedido dp ON p.idpedido = dp.idpedido
    WHERE 
        p.idusuario = ? AND p.estado IN (1, 2, 3)
    ORDER BY 
        p.idpedido, dp.nombreproducto;
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$result = $stmt->get_result();

// Inicializamos variables para rastrear el pedido actual
$pedidoAnterior = null;
$productos = $preciosDescuento = $cantidades = "";

// Muestra los pedidos y sus productos
if ($result->num_rows > 0) {
    while ($pedido = $result->fetch_assoc()) {
        if ($pedidoAnterior !== $pedido['idpedido']) {
            // Si es un nuevo pedido, imprimimos el pedido anterior
            if ($pedidoAnterior !== null) {
                // HTML del pedido
                echo "
                <div class='row general'>
                    <div class='col-1 col-md-1 prueba'></div>
                    <div class='col-10 col-md-10 prueba'>
                        <div class='caja'>
                            <div class='row'>
                                <div class='col-2 col-md-2'>
                                    <div class='row'>
                                        <div class='col-12 col-md-12'>Pedido</div>
                                        <div class='col-12 col-md-12'>#$pedidoAnterior</div>
                                    </div>
                                </div>
                                <div class='col-3 col-md-3'>
                                    <div class='row'>
                                        <div class='col-12 col-md-12'>Fecha Pedido</div>
                                        <div class='col-12 col-md-12'>{$fecha}</div>
                                    </div>
                                </div>
                                <div class='col-3 col-md-3'>
                                    <div class='row'>
                                        <div class='col-12 col-md-12'>Total</div>
                                        <div class='col-12 col-md-12'>S/. {$total}</div>
                                    </div>
                                </div>
                                <div class='col-3 col-md-3'>
                                    <div class='row'>
                                        <div class='col-12 col-md-12'>Estado</div>
                                        <div class='col-12 col-md-12'>
                                        ";
                                        if($estado ==1){
                                            echo "En tienda";
                                        }elseif($estado == 2){
                                            echo "En Proceso de entrega";
                                        }elseif($estado == 3){
                                            echo "Entregado";
                                        };                               
                                        echo "</div>
                                    </div>
                                </div>
                                <div class='col-1 col-md-1 boton'><button class='boton'><i class='fa-solid fa-caret-down'></i></button></div>
                            </div>
                        </div>
                        <div class='desplegable'>
                            <div class='row'>
                                <div class='col-7 col-md-7'>
                                    <div class='row productos'>
                                        <div class='col-12 col-md-12 titulosd'>Productos</div>
                                        $productos
                                    </div>
                                </div>
                                <div class='col-3 col-md-3'>
                                    <div class='col-12 col-md-12 titulosd'>Precio Uni</div>
                                    $preciosDescuento
                                </div>
                                <div class='col-2 col-md-2'>
                                    <div class='col-12 col-md-12 titulosd'>Cantidad</div>
                                    $cantidades
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-1 col-md-1 prueba'></div>
                </div>
                ";

                // Reiniciamos las variables acumuladoras
                $productos = $preciosDescuento = $cantidades = "";
            }

            // Asignamos los datos del nuevo pedido
            $pedidoAnterior = $pedido['idpedido'];
            $total = $pedido['total'];
            $fecha = $pedido['fecha'];
            $estado = $pedido['estado'];
        }

        // Acumulamos los datos de los productos
        $productos .= "<div class='col-12 col-md-12'>{$pedido['nombreproducto']}</div>";
        $preciosDescuento .= "<div class='col-12 col-md-12'>S/. {$pedido['preciodescuento']}</div>";
        $cantidades .= "<div class='col-12 col-md-12'>{$pedido['cantidad_producto']}</div>";
    }

    // Imprimimos el último pedido acumulado
    echo "
    <div class='row general'>
        <div class='col-1 col-md-1 prueba'></div>
        <div class='col-10 col-md-10 prueba'>
            <div class='caja'>
                <div class='row'>
                    <div class='col-2 col-md-2'>
                        <div class='row'>
                            <div class='col-12 col-md-12'>Pedido</div>
                            <div class='col-12 col-md-12'>#$pedidoAnterior</div>
                        </div>
                    </div>
                    <div class='col-3 col-md-3'>
                        <div class='row'>
                            <div class='col-12 col-md-12'>Fecha Pedido</div>
                            <div class='col-12 col-md-12'>{$fecha}</div>
                        </div>
                    </div>
                    <div class='col-3 col-md-3'>
                        <div class='row'>
                            <div class='col-12 col-md-12'>Total</div>
                            <div class='col-12 col-md-12'>S/. {$total}</div>
                        </div>
                    </div>
                    <div class='col-3 col-md-3'>
                        <div class='row'>
                            <div class='col-12 col-md-12'>Estado</div>
                            <div class='col-12 col-md-12'>
                                        ";
                                        if($estado ==1){
                                            echo "En tienda";
                                        }elseif($estado == 2){
                                            echo "En Proceso de entrega";
                                        }elseif($estado == 3){
                                            echo "Entregado";
                                        };                               
                                        echo "</div>
                        </div>
                    </div>
                    <div class='col-1 col-md-1 boton'><button class='boton'><i class='fa-solid fa-caret-down'></i></button></div>
                </div>
            </div>
            <div class='desplegable'>
                <div class='row'>
                    <div class='col-7 col-md-7'>
                        <div class='row productos'>
                            <div class='col-12 col-md-12 titulosd'>Productos</div>
                            $productos
                        </div>
                    </div>
                    <div class='col-3 col-md-3'>
                        <div class='col-12 col-md-12 titulosd'>Precio Uni</div>
                        $preciosDescuento
                    </div>
                    <div class='col-2 col-md-2'>
                        <div class='col-12 col-md-12 titulosd'>Cantidad</div>
                        $cantidades
                    </div>
                </div>
            </div>
        </div>
        <div class='col-1 col-md-1 prueba'></div>
    </div>
    ";
} else {
    echo "No hay pedidos disponibles.";
}

$stmt->close();
$conn->close();
?>
