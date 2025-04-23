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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/productosadmi.css">

</head>

<body>

    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
    </header>


    <div class="container-fluid titulo-agregar">
        <h2>Panel de Proveedores</h2>

        <!-- Botón para agregar un nuevo producto -->
        <button class="btn agregar mb-3 " data-bs-toggle="modal" data-bs-target="#addProveedorModal">Agregar Proveedor</button>
        <!-- Filtro de Categorías -->
    </div>

    <div class="container-fluid">
        <div class="row filtros">
            <div class="col-12 col-md-12">
                <h3>Busqueda:</h3>
            </div>
            
            <div class="col-12 col-md-12"> <!-- Barra de búsqueda -->
                <label for="categoryFilter" class="tipo-filtro mt-3">Proveedor:</label>
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Nombre Proveedor...">
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="proveedorTable">
                <!-- Los productos se cargarán aquí mediante AJAX -->
            </tbody>
        </table>


    </div>
<!-- Modal para agregar producto -->
<div class="modal fade" id="addProveedorModal" tabindex="-1" aria-labelledby="addProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProveedorForm" method="POST" action="tu_script_php.php">
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="nombreprov" class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="nombreprov" name="nombreprov" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccionprov" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccionprov" name="direccionprov" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoprov" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoprov" name="telefonoprov" pattern="\d{9}" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="mb-3">
                        <label for="emailprov" class="form-label">Email</label>
                        <input type="text" class="form-control" id="emailprov" name="emailprov" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Agregar Proveedor</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="editProveedorModal" tabindex="-1" aria-labelledby="editProveedorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProveedorModalLabel">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProveedorForm">
                        <input type="hidden" id="edit_idproveedor" name="idproveedor">
                        <!-- Campos del formulario de edición (similares al de agregar) -->
                    <div class="mb-3">
                        <label for="nombreprov" class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="editarnombreprov" name="nombreprov" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccionprov" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="editardireccionprov" name="direccionprov" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefonoprov" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="editartelefonoprov" name="telefonoprov" required pattern="\d{9}" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="mb-3">
                        <label for="emailprov" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editaremailprov" name="emailprov"required>
                    </div>
                        <!-- Botón para guardar cambios -->
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
    <script src='../../assets/js/usuario.js'></script>
</body>

</html>