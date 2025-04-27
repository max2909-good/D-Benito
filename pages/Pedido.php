<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/pedido.css">
    <title>Pedido</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>


    <main>
        <div class="container-fluid contenidoped">
<?php
        include('../logic/ListaPedido.php');
        ?>
</div>
    </main>

    <?php include '../includes/footer.html'; ?>
    <script src='../assets/js/pedido.js'></script>
</body>

</html>