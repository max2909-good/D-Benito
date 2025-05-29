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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/productosadmi.css">
        <link rel="stylesheet" href="/assets/css/usuario.css">


</head>

<body class="bg-light text-dark">

    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
    </header>

    <!-- Contenido principal -->
    <div class="container py-4">

        <!-- Título -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold" style="color: #8B4513;">Panel de Usuario</h2>
        </div>

        <!-- Filtros -->
        <div class="card shadow-sm p-4 mb-4 border-0" style="background-color: #fff5e6;">
            <h4 class="mb-3 text-dark">Búsqueda</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rolFilter" class="form-label">Rol:</label>
                    <select class="form-select" id="rolFilter">
                        <option value="">Todos los Roles</option>
                        <?php
                        include '../../includes/conexion.php';
                        $sql = "SELECT * FROM rol";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['idrol']}'>{$row['nombrerol']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="searchInput" class="form-label">Nombre:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre...">
                </div>
            </div>
        </div>

        <!-- Tabla de usuarios -->
        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle">
                <thead style="background-color: #8B4513; color: white;">
                    <tr>
                        <th rowspan="2">ID</th>
                        <th rowspan="2">Rol</th>
                        <th rowspan="2">Nombre</th>
                        <th rowspan="2">Email</th>
                        <th rowspan="2">Celular</th>
                        <th rowspan="2">Dirección</th>
                        <th rowspan="2">Usuario</th>
                        <th colspan="2" class="text-center">Cambiar a:</th>
                    </tr>
                    <tr>
                        <th>Cliente</th>
                        <th>Empleado</th>
                    </tr>
                </thead>
                <tbody id="UsuarioTable">
                    <!-- Contenido dinámico -->
                </tbody>
            </table>
        </div>

    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
    <script src='../../assets/js/usuario.js'></script>
</body>



</html>