<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/Categorias.css">
    <title>Categorias</title>
</head>

<body>
<?php include '../includes/header.php'; ?>
    <!-- Banner -->
    <section class="banner" style="background-image: linear-gradient(100deg, #000000, #00000020), url('<?php include('../logic/nom_categoria.php');echo $imagen; ?>');">
        <div class="content-banner">
            <h1><?php include('../logic/nom_categoria.php'); echo $nombrecategoria; ?></h1>
        </div>
    </section>
    <!--Fin Banner -->
    
        <?php
        include('../logic/nom_categoria.php');
        $categoria = $nombrecategoria;
        include('../logic/Lista.php');
        ?>
<!-- Contenedor del modal -->
<div id="product-modal" class="product-modal hidden">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <div class="modal-image">
            <img id="modal-product-image" src="" alt="" class="img-fluid">
        </div>
        <div class="modal-info">
            <h3 id="modal-product-name"></h3>
            <div class="modal-price" id="modal-product-price"></div>
            <div class="star-container" id="modal-product-rating"></div>
        </div>
    </div>
</div>
<!-- Fin lista de Productos -->
<?php include '../includes/footer.html'; ?>
</body>

</html>