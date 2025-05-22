<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logeado y si tiene el rol adecuado
if (!isset($_SESSION['idusuario']) || $_SESSION['idrol'] != 1) {
    // Redirigir al login o a una página de acceso no autorizado
    header("Location: ../../pages/login.html");
    exit();
}
require '../../includes/conexion.php';

// Obtener las fechas desde el formulario (si están presentes)
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

// Consulta para los totales generales
$totalQuery = "
    SELECT 
        SUM(total) AS total_ingreso,
        SUM(totalproductos) AS total_productos_vendidos
    FROM 
        pedido
    WHERE 
        estado = 3
        AND (DATE(fecha) BETWEEN ? AND ? OR (? IS NULL AND ? IS NULL))
";
$stmtTotal = $conn->prepare($totalQuery);
$stmtTotal->bind_param("ssss", $startDate, $endDate, $startDate, $endDate);
$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
$totals = $totalResult->fetch_assoc();
$totalIngreso = $totals['total_ingreso'] ?? 0;
$totalProductos = $totals['total_productos_vendidos'] ?? 0;
$stmtTotal->close();

// Consulta para los productos vendidos
$productQuery = "
    SELECT 
        dp.nombreproducto,
        SUM(dp.cantidad) AS cantidad_total_vendida,
        SUM(dp.cantidad * dp.preciodescuento) AS total_recaudado
    FROM 
        pedido p
    JOIN 
        detallespedido dp ON p.idpedido = dp.idpedido
    WHERE 
        p.estado = 3
        AND (DATE(p.fecha) BETWEEN ? AND ? OR (? IS NULL AND ? IS NULL))
    GROUP BY 
        dp.nombreproducto
    ORDER BY 
        total_recaudado DESC";
$stmtProduct = $conn->prepare($productQuery);
$stmtProduct->bind_param("ssss", $startDate, $endDate, $startDate, $endDate);
$stmtProduct->execute();
$productResult = $stmtProduct->get_result();

// Inicializar array de productos
$productos = [];
while ($row = $productResult->fetch_assoc()) {
    $productos[] = $row;
}
$stmtProduct->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/productosadmi.css">
</head>

<body>
    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
    </header>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Reporte Consolidado de Ventas</h1>

        <!-- Formulario de filtro por fechas -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-5">
                <label for="start_date" class="form-label">Fecha de Inicio</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $startDate ?>">
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">Fecha de Fin</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $endDate ?>">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>

        <!-- Botón para restablecer el filtro -->
        <div class="text-end mb-4">
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-secondary">Restablecer Filtro</a>
        </div>

        <!-- Resumen General -->
        <?php if (empty($productos)): ?>
            <p class="text-center">No hay datos disponibles para el rango seleccionado.</p>
        <?php else: ?>
           <div class="row mb-4">
    <h2 class="mb-3 text-center text-personalizado">Resumen General</h2>

    <div class="col-md-6">
        <div class="card shadow-sm border-personalizar">
            <div class="card-body text-center">
                <h5 class="card-title text-secondary">Total de Ingresos</h5>
                <p class="card-text display-6 text-success fw-bold">S/ <?= number_format($totalIngreso, 2) ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-personalizar">
            <div class="card-body text-center">
                <h5 class="card-title text-secondary">Total de Productos Vendidos</h5>
                <p class="card-text display-6 text-warning fw-bold"><?= $totalProductos ?></p>
            </div>
        </div>
    </div>
</div>


            <!-- Tabla de Productos Consolidados -->
           <div class="card shadow-sm border-personalizar mb-5">
    <div class="card-header bg-personalizado d-flex align-items-center">
        <i class="fas fa-box me-2"></i>
        <h5 class="mb-0 text-center">Productos Más Vendidos</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-personalizada mb-0">
                <thead class="text-center">
                    <tr>
                         <th>Producto</th>
                        <th>Cantidad Total Vendida</th>
                        <th>Total Recaudado (S/)</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= $producto['nombreproducto'] ?></td>
                            <td><?= $producto['cantidad_total_vendida'] ?></td>
                            <td class="fw-bold-green">S/ <?= number_format($producto['total_recaudado'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
    <script src='../../assets/js/usuario.js'></script>
</body>

</html>