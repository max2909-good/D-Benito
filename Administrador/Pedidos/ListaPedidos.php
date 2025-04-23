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

// Verificar si se está enviando algún formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['idpedido'])) {
        $idpedido = $_POST['idpedido'];
        $estadoNuevo = null;

        // Verificar si se marcó el checkbox 'tienda_checkbox'
        if (isset($_POST['tienda_checkbox'])) {
            $estadoNuevo = 2; // 'En Proceso de entrega'
        }

        // Verificar si se marcó el checkbox 'entregado_checkbox'
        if (isset($_POST['entregado_checkbox'])) {
            $estadoNuevo = 3; // 'Entregado'
        }

        // Si se ha establecido un nuevo estado, actualizarlo en la base de datos
        if ($estadoNuevo !== null) {
            $sqlUpdate = "UPDATE pedido SET estado = ? WHERE idpedido = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ii", $estadoNuevo, $idpedido);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }
    }
}

// Variables de los filtros
$selected_category = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$selected_status = isset($_POST['estado']) ? $_POST['estado'] : '';
$selected_usuario_name = isset($_POST['nombreusuario']) ? $_POST['nombreusuario'] : '';
$selected_date = isset($_POST['fecha']) ? $_POST['fecha'] : '';

// Consulta base
$sql = "
    SELECT 
        p.idpedido,
        p.idusuario,
        p.total,
        p.estado,
        p.fecha,
        dp.nombreproducto,
        dp.preciodescuento,
        dp.cantidad AS cantidad_producto,
        u.nombreusuario,
        u.telefonousuario,
        u.direccionusuario
    FROM 
        pedido p
    INNER JOIN 
        detallespedido dp ON p.idpedido = dp.idpedido
    INNER JOIN
        usuario u ON p.idusuario = u.idusuario
    WHERE 
        p.estado IN (1, 2, 3)
";

// Añadir condiciones según los filtros
$conditions = [];
if ($selected_category != '') {
    $conditions[] = "p.idcategoria = '$selected_category'";
}
if ($selected_status != '') {
    $conditions[] = "p.estado = '$selected_status'";
}
if ($selected_usuario_id != '') {
    $conditions[] = "u.idusuario = '$selected_usuario_id'";
}
if ($selected_date != '') {
    $conditions[] = "DATE(p.fecha) = '$selected_date'";
}

if (count($conditions) > 0) {
    $sql .= " AND " . implode(' AND ', $conditions);
}

$sql .= " ORDER BY p.idpedido, dp.nombreproducto";

$result = $conn->query($sql);

// Inicializamos variables antes del bucle
$pedidoAnterior = null;
$productos = $preciosDescuento = $cantidades = "";
$nombreusuario = $telefonousuario = $direccionusuario = $idpedido = $total = $fecha = $estado = null;

// Muestra los pedidos y sus productos
if ($result->num_rows > 0) {
    while ($pedido = $result->fetch_assoc()) {
        // Si es un nuevo pedido, imprimimos el pedido anterior
        if ($pedidoAnterior !== $pedido['idpedido']) {
            // Si no es la primera iteración, imprimimos el pedido anterior
            if ($pedidoAnterior !== null) {
                echo "
                <div class='row general'>
                    <div class='col-1 col-md-1 prueba'></div>
                    <div class='col-10 col-md-10 prueba'>
                        <div class='caja'>
                            <div class='row'>
                                <div class='col-1 col-md-1'>$pedidoAnterior</div>
                                <div class='col-2 col-md-2'>{$nombreusuario}</div>
                                <div class='col-2 col-md-2'>{$fecha}</div>
                                <div class='col-1 col-md-1'>{$telefonousuario}</div>
                                <div class='col-3 col-md-3'>{$direccionusuario}</div>
                                <div class='col-1 col-md-1'>S/{$total}</div>
                                <div class='col-1 col-md-1'>";

                                // Mostrar el estado
                                if ($estado == 1) {
                                    echo "En tienda";
                                } elseif ($estado == 2) {
                                    echo "En Proceso de entrega";
                                } elseif ($estado == 3) {
                                    echo "Entregado";
                                }

                                echo "</div>
                                <div class='col-1 col-md-1 boton'><button class='boton'><i class='fa-solid fa-caret-down'></i></button></div>
                            </div>
                        </div>";

                        // Mostrar el formulario dependiendo del estado
                        if($estado == 1){
                            echo "<div class='estadopedido'>
                                    <div class='row'>
                                        <div class='col-4 col-md-4'></div>
                                        <div class='col-4 col-md-4'></div>
                                        <div class='col-4 col-md-4'>
                                            <form method='post'>
                                                <input type='hidden' name='idpedido' value='{$idpedido}'>
                                                <label><input type='checkbox' name='tienda_checkbox' class='custom-checkbox'> Marcar como Proceso de entrega</label>
                                                <button type='submit' class='btn btn-guardar'>Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>";
                        } elseif($estado == 2){
                            echo "<div class='estadopedido'>
                                    <div class='row'>
                                        <div class='col-4 col-md-4'></div>
                                        <div class='col-4 col-md-4'></div>
                                        <div class='col-4 col-md-4'>
                                            <form method='post'>
                                                <input type='hidden' name='idpedido' value='{$idpedido}'>
                                                <label><input type='checkbox' name='entregado_checkbox' class='custom-checkbox'> Marcar como Entregado</label>
                                                <button type='submit' class='btn btn-guardar'>Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>";
                        }

                        echo "<div class='desplegable'>
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
                </div>";

                // Reiniciamos las variables acumuladoras
                $productos = $preciosDescuento = $cantidades = "";
            }

            // Asignamos los datos del nuevo pedido
            $pedidoAnterior = $pedido['idpedido'];
            $nombreusuario = $pedido['nombreusuario'];
            $telefonousuario = $pedido['telefonousuario'];
            $direccionusuario = $pedido['direccionusuario'];
            $idpedido = $pedido['idpedido'];
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
                    <div class='col-1 col-md-1'>$pedidoAnterior</div>
                    <div class='col-2 col-md-2'>{$nombreusuario}</div>
                    <div class='col-2 col-md-2'>{$fecha}</div>
                    <div class='col-1 col-md-1'>{$telefonousuario}</div>
                    <div class='col-3 col-md-3'>{$direccionusuario}</div>
                    <div class='col-1 col-md-1'>S/{$total}</div>
                    <div class='col-1 col-md-1'>";

                    // Mostrar el estado
                    if ($estado == 1) {
                        echo "En tienda";
                    } elseif ($estado == 2) {
                        echo "En Proceso de entrega";
                    } elseif ($estado == 3) {
                        echo "Entregado";
                    }

                    echo "</div>
                    <div class='col-1 col-md-1 boton'><button class='boton'><i class='fa-solid fa-caret-down'></i></button></div>
                </div>
            </div>";

        // Mostrar los productos
        echo "<div class='desplegable'>
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
</div>";
} else {
    echo "No se encontraron resultados para los filtros seleccionados.";
}
?>
