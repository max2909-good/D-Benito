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
require '../../includes/conexion.php';

$query = $_POST['query'];
$sql = "SELECT producto.*, categoria.nombrecategoria, proveedor.nombreprov 
FROM producto 
JOIN proveedor ON producto.idproveedor = proveedor.idproveedor 
JOIN categoria ON producto.idcategoria = categoria.idcategoria 
WHERE producto.nombreproducto LIKE '%$query%' 
   OR proveedor.nombreprov LIKE '%$query%' 
   OR categoria.nombrecategoria LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['idproducto']}</td>
        <td>{$row['nombrecategoria']}</td>
        <td>{$row['nombreprov']}</td>
        <td>{$row['nombreproducto']}</td>
        <td>S/ {$row['preciooriginal']}</td>
        <td>{$row['porcentajedescuento']}%
        </td>
        <td id='precio_descuento_{$row['idproducto']}'>S/ {$row['preciodescuento']}</td>
        <td>{$row['calificacion']}</td>
        <td>{$row['cantidad']}</td>
        <td>
            <button class='btn btn-warning btn-sm btn-edit custom-button-size actualizar' data-id='{$row['idproducto']}'>Editar</button>
            <button class='btn btn-danger btn-sm btn-delete custom-button-size eliminar' data-id='{$row['idproducto']}'>Eliminar</button>";
            if ($row['porcentajedescuento'] > 0) {
                echo "<button class='btn btn-sm btn-secondary custom-button-size actualizarprecio' data-id='{$row['idproducto']}'>Quitar Descuento</button>";
            }
            
        echo "
            </td>
      </tr>";
    }
} else {
    echo "<tr><td colspan='10' class='text-center'>No se encontraron resultados</td></tr>";
}
$conn->close();
