<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/indexAdmi.css">
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

    <!-- Encabezado -->
    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
       
    </header>
     <!-- Contenido principal -->
     <main class="container py-4">
        <!-- Título Principal -->
        <div class="text-center mb-4">
            <h1 class="display-5">Bienvenido al Panel de Administración</h1>
            <p class="lead">Aquí puedes gestionar pedidos, productos y más.</p>
        </div>
 <!-- Información de construcción del panel -->
 <section class="mb-5">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Bodega D´Benito</h5>
                    <p class="card-text">Donde la eficiencia y eficacia de sus sistemas logran una mayor produccion en la tienda.</p>
                </div>
            </div>
        </section>

        <!-- Cards informativas -->
        <section>
            <div class="row g-4">
                <!-- Productos -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <h5 class="card-title text-center">Productos</h5>
                        <p class="text-muted text-center">Administra el catálogo de productos disponibles en el sistema.</p>
                        <div class="text-center">
                            <a href='../Productos/productos.php' class="btn btn-outline-primary btn-sm">Ver productos</a>
                        </div>
                    </div>
                </div>

                <!-- Pedidos -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h5 class="card-title text-center">Pedidos</h5>
                        <p class="text-muted text-center">Consulta y gestiona los pedidos realizados por los clientes.</p>
                        <div class="text-center">
                            <a href=../Pedidos/pedidos.php class="btn btn-outline-success btn-sm">Ver pedidos</a>
                        </div>
                    </div>
                </div>
                  <!-- Usuarios -->
                  <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <h5 class="card-title text-center">Usuarios</h5>
                        <p class="text-muted text-center">Gestiona los permisos y accesos de los usuarios registrados.</p>
                        <div class="text-center">
                            <a href='../Usuario/usuario.php' class="btn btn-outline-warning btn-sm">Ver usuarios</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <!-- Proveedores -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h5 class="card-title text-center">Proveedores</h5>
                        <p class="text-muted text-center">Administra el catálogo de proveedores de forma ordenada y eficaz.</p>
                        <div class="text-center">
                            <a href='../Proveedor/proveedor.php' class="btn btn-outline-primary btn-sm">Ver Proveedores</a>
                        </div>
                    </div>
                </div>

                <!-- Ventas -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h5 class="card-title text-center">Ventas</h5>
                        <p class="text-muted text-center">Consulta y gestiona las ventas de tu negocio de manera eficiente.</p>
                        <div class="text-center">
                            <a href='../Ventas/ventas.php' class="btn btn-outline-success btn-sm">Ver Ventas</a>
                        </div>
                    </div>
                </div>

                <!-- Reportes (opcional) -->
                <div class="col-md-4">
                    <div class="card shadow-sm p-3">
                        <div class="text-center icon-box mb-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="card-title text-center">Reportes</h5>
                        <p class="text-muted text-center">Visualiza reportes de ventas, pedidos y productos.</p>
                        <div class="text-center">
                            <a href="../Ventas/ventas.php" class="btn btn-outline-info btn-sm">Ver Reportes</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../../Administrador/footer.html'; ?>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS personalizado -->
    <script src='../../assets/js/usuario.js'></script>
    

</body>
</html>