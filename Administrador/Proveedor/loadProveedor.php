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


$sql = "SELECT * FROM proveedor";


$result = $conn->query($sql);
if ($result->num_rows > 0) {  // Se verifica si hay filas
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['idproveedor']}</td>
        <td>{$row['nombreprov']}</td>
        <td>{$row['direccionprov']}</td>
        <td>{$row['telefonoprov']}</td>
        <td>{$row['emailprov']}</td>
        <td>
            <button class='btn btn-warning btn-sm btn-edit custom-button-size actualizar' data-id='{$row['idproveedor']}'>Editar</button>
            </td>
      </tr>";
    }
} else {
    echo "No existen proveedores";
}

$conn->close();
