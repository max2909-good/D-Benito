<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/carrito.css">
    <title>Carrito</title>
    <!-- Cargar jQuery antes de cualquier script que lo utilice -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <!-- Contenido del Carrito -->
    <main class="main-content">
        <section class="container cart-section">
            <div class="container-cart-items">
                <div class="container">
                    <?php include '../logic/ListaCarrito.php'; ?>
                </div>
            </div>
        </section>
    </main>
    <!-- Fin lista de Productos -->
    <?php include '../includes/footer.html'; ?>

</body>

</html>