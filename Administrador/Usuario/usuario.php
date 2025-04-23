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

</head>

<body>

    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
    </header>


    <div class="container-fluid titulo-agregar">
        <h2>Panel de Usuario</h2>

        <!-- Filtro de Categorías -->
    </div>

    <div class="container-fluid">
        <div class="row filtros">
            <div class="col-12 col-md-12">
                <h3>Busqueda:</h3>
            </div>
            <div class="col-6 col-md-6">
                <div class="form-group mt-3">
                    <label for="rolFilter" class="tipo-filtro">Rol:</label>
                    <select class="form-control" id="rolFilter">
                        <option value="">Todas los Roles</option>
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
            </div>
            <div class="col-6 col-md-6"> <!-- Barra de búsqueda -->
                <label for="rolFilter" class="tipo-filtro mt-3">Nombre:</label>
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Nombre...">
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th rowspan="2">ID</th>
                    <th rowspan="2">Rol</th>
                    <th rowspan="2">Nombre</th>
                    <th rowspan="2">Email</th>
                    <th rowspan="2">Celular</th>
                    <th rowspan="2">Dirección</th>
                    <th rowspan="2">Usuario</th>
                    <th colspan="2">Cambiar a:</th> <!-- Encabezado combinado -->
        </tr>
        <tr>
            <th>Cliente</th>
            <th>Empleado</th>
        </tr>
            </thead>
            <tbody id="UsuarioTable">
                <!-- Los productos se cargarán aquí mediante AJAX -->
            </tbody>
        </table>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
    <script src='../../assets/js/usuario.js'></script>
</body>

</html>