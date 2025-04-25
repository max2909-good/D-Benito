<?php
// Arreglo de categorías
$categorias = [
    1 => ['nombre' => 'Alimentos', 'imagen' => '/assets/img/AlimentosBann.jpeg'],
    2 => ['nombre' => 'Bebidas', 'imagen' => '/assets/img/BebidasBann.jpeg'],
    3 => ['nombre' => 'Lácteos', 'imagen' => '/assets/img/LacteosBann.jpeg'],
    4 => ['nombre' => 'Carnes y Aves', 'imagen' => '/assets/img/CarnesBann.jpeg'],
    5 => ['nombre' => 'Verduras', 'imagen' => '/assets/img/verduras.jpeg'],
    6 => ['nombre' => 'Frutas', 'imagen' => '/assets/img/FrutasBann.jpeg'],
    7 => ['nombre' => 'Panadería', 'imagen' => '/assets/img/PanaderiaBann.jpeg'],
    8 => ['nombre' => 'Limpieza', 'imagen' => '/assets/img/LimpiezaBann.jpeg'],
    9 => ['nombre' => 'Aseo Personal', 'imagen' => '/assets/img/AseoPersonalBann.jpeg'],
    10 => ['nombre' => 'Mascotas', 'imagen' => '/assets/img/MascotasBann.jpeg'],
    11 => ['nombre' => 'Papelería', 'imagen' => '/assets/img/PapeleriaBann.jpeg'],
    12 => ['nombre' => 'Suministros Médicos', 'imagen' => '/assets/img/SuministrosMedicosBann.jpeg'],
    13 => ['nombre' => 'Snacks', 'imagen' => '/assets/img/SnacksBann.jpeg'],
];

// Obtener el ID de la categoría de la URL
$id_categoria = isset($_GET['id']) ? intval($_GET['id']) : null;

// Verificar si el ID de la categoría es válido
if ($id_categoria && isset($categorias[$id_categoria])) {
    $nombrecategoria = $categorias[$id_categoria]['nombre'];
    $imagen = $categorias[$id_categoria]['imagen'];
} else {
    // Si no es válido, manejar el error
    $nombrecategoria = 'Categoría no encontrada';
    $imagen = 'ruta/a/la/imagen/error.jpg'; // Imagen de error
}
?>
