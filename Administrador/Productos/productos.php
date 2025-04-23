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
    <title>Panel de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/productosadmi.css">

</head>

<body>

    <header>
        <?php include '../../Administrador/headerAdmin.php'; ?>
    </header>


    <div class="container-fluid titulo-agregar">
        <h2>Panel de Productos</h2>

        <!-- Botón para agregar un nuevo producto -->
        <button class="btn agregar mb-3 " data-bs-toggle="modal" data-bs-target="#addProductModal">Agregar Producto</button>
        <!-- Filtro de Categorías -->
    </div>

    <div class="container-fluid">
        <div class="row filtros">
            <div class="col-12 col-md-12">
                <h3>Busqueda:</h3>
            </div>
            <div class="col-6 col-md-6">
                <div class="form-group mt-3">
                    <label for="categoryFilter" class="tipo-filtro">Categoría:</label>
                    <select class="form-control" id="categoryFilter">
                        <option value="">Todas las Categorías</option>
                        <?php
                        include '../../includes/conexion.php';
                        $sql = "SELECT * FROM categoria";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['idcategoria']}'>{$row['nombrecategoria']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6 col-md-6"> <!-- Barra de búsqueda -->
                <label for="categoryFilter" class="tipo-filtro mt-3">Producto:</label>
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Nombre Producto...">
            </div>
        </div>

        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Nombre del Producto</th>
                    <th>Precio</th>
                    <th>% Descuento</th>
                    <th>Precio con <br>Descuento</th>
                    <th>Calificación</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productTable">
                <!-- Los productos se cargarán aquí mediante AJAX -->
            </tbody>
        </table>


    </div>
<!-- Modal para agregar producto -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" method="POST" action="tu_script_php.php">
                    <!-- Campos del formulario -->
                    <div class="mb-3">
                        <label for="idcategoria" class="form-label">Categoría</label>
                        <select class="form-control" id="idcategoria" name="idcategoria" required>
                            <option value="">Seleccione una categoría</option>
                            <?php
                            include '../../includes/conexion.php';
                            $sql = "SELECT * FROM categoria";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['idcategoria']}'>{$row['nombrecategoria']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="idproveedor" class="form-label">Proveedor</label>
                        <select class="form-control" id="idproveedor" name="idproveedor" required>
                            <option value="">Seleccione un proveedor</option>
                            <?php
                            $sql = "SELECT * FROM proveedor";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['idproveedor']}'>{$row['nombreprov']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombreproducto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombreproducto" name="nombreproducto" required>
                    </div>
                    <div class="mb-3">
                        <label for="enlace" class="form-label">Enlace</label>
                        <input type="url" class="form-control" id="enlace" name="enlace" required>
                    </div>
                    <div class="mb-3">
                        <label for="preciooriginal" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="preciooriginal" name="preciooriginal" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipoDescuento" class="form-label">Tipo de Descuento</label>
                        <select class="form-control" id="tipoDescuento" name="tipoDescuento" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="porcentaje">Porcentaje de Descuento</option>
                            <option value="precio">Precio con Descuento</option>
                        </select>
                    </div>

                    <div class="mb-3" id="descuentoPorcentaje" style="display: none;">
                        <label for="porcentajedescuento" class="form-label">Descuento (%)</label>
                        <input type="number" step="0.01" class="form-control" id="porcentajedescuento" name="porcentajedescuento" min="0" max="100">
                    </div>

                    <div class="mb-3" id="descuentoPrecio" style="display: none;">
                        <label for="preciodescuento" class="form-label">Precio con Descuento</label>
                        <input type="number" step="0.01" class="form-control" id="preciodescuento" name="preciodescuento" min="0">
                    </div>

                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación</label>
                        <input type="number" class="form-control" id="calificacion" name="calificacion" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" min="0" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar Producto</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="edit_idproducto" name="idproducto">
                        <!-- Campos del formulario de edición (similares al de agregar) -->
                        <div class="mb-3">
                        <label for="idcategoria" class="form-label">Categoría</label>
                        <select class="form-control" id="editaridcategoria" name="idcategoria" required>
                            <option value="">Seleccione una categoría</option>
                            <?php
                            include '../../includes/conexion.php';
                            $sql = "SELECT * FROM categoria";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['idcategoria']}'>{$row['nombrecategoria']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="idproveedor" class="form-label">Proveedor</label>
                        <select class="form-control" id="editaridproveedor" name="idproveedor" required>
                            <option value="">Seleccione un proveedor</option>
                            <?php
                            $sql = "SELECT * FROM proveedor";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['idproveedor']}'>{$row['nombreprov']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombreproducto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="editarnombreproducto" name="nombreproducto" required>
                    </div>
                    <div class="mb-3">
                        <label for="enlace" class="form-label">Enlace</label>
                        <input type="url" class="form-control" id="editarenlace" name="enlace" required>
                    </div>
                    <div class="mb-3">
                        <label for="preciooriginal" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="editarpreciooriginal" name="preciooriginal" required>
                    </div>
                    <div class="mb-3">
                        <label for="editartipoDescuento" class="form-label">Tipo de Descuento</label>
                        <select class="form-control" id="editartipoDescuento" name="editartipoDescuento" required>
                            <option value="">Seleccionar tipo</option>
                            <option value="editarporcentaje">Porcentaje de Descuento</option>
                            <option value="editarprecio">Precio con Descuento</option>
                        </select>
                    </div>

                    <div class="mb-3" id="editardescuentoPorcentaje" style="display: none;">
                        <label for="editarporcentajedescuento" class="form-label">Descuento (%)</label>
                        <input type="number" step="0.01" class="form-control" id="editarporcentajedescuento" name="editarporcentajedescuento" min="0" max="100">
                    </div>

                    <div class="mb-3" id="editardescuentoPrecio" style="display: none;">
                        <label for="editarpreciodescuento" class="form-label">Precio con Descuento</label>
                        <input type="number" step="0.01" class="form-control" id="editarpreciodescuento" name="editarpreciodescuento" min="0">
                    </div>

                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación</label>
                        <input type="number" class="form-control" id="editarcalificacion" name="calificacion" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="editarcantidad" name="cantidad" min="0" required>
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