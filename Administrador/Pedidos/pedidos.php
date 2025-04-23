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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/pedidosAdmi.css">
    <title>Panel de Pedido</title>
</head>

<body>
<?php include '../../Administrador/headerAdmin.php'; ?>


    <main>
    <?php include('filtrospedidos.php'); ?>
        <form method="post" action="" class="filtro" id="filterForm">
            <div class="form-group">
                <label for="estado">Estado del Pedido:</label>
                <select id="estado" name="estado">
                    <option value="">Todos</option>
                    <option value="1" <?php if ($selected_status == '1') echo 'selected'; ?>>En tienda</option>
                    <option value="2" <?php if ($selected_status == '2') echo 'selected'; ?>>En proceso de entrega</option>
                    <option value="3" <?php if ($selected_status == '3') echo 'selected'; ?>>Entregado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombreusuario">Nombre del Cliente:</label>
                <select id="nombreusuario" name="nombreusuario">
                    <option value="">Todos</option>
                    <?php
                    if ($usuario_result->num_rows > 0) {
                        while ($usuario = $usuario_result->fetch_assoc()) {
                            $selected = $selected_usuario_id == $usuario['idusuario'] ? 'selected' : '';
                            echo "<option value='{$usuario['idusuario']}' $selected>{$usuario['nombreusuario']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha del Pedido:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $selected_date; ?>">
            </div>
            <button type="submit" class="btn btn-guardar">Buscar</button>
            <button type="reset" class="btn btn-restablecer" onclick="resetFilters()">Restablecer</button>
        </form>
        
        <div class="container contenidoped">
            <?php
            include('ListaPedidos.php');
            ?>
        </div>
    </main>

    <script>
        function resetFilters() {
            document.getElementById('estado').value = '';
            document.getElementById('nombrecliente').value = '';
            document.getElementById('fecha').value = '';
            // Enviar el formulario sin filtros
            document.getElementById('filterForm').submit();
        }
    </script>
    <script src='../../assets/js/pedido.js'></script>
    <script src="https://kit.fontawesome.com/b0e5501fac.js" crossorigin="anonymous"></script>
    <script src='../../assets/js/usuario.js'></script>
</body>

</html>