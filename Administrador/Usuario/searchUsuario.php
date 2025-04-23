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
require '../../includes/conexion.php';

$query = $_POST['query'];
$sql = "SELECT u.*, r.nombrerol
        FROM usuario u 
        JOIN rol r ON u.idrol = r.idrol
        WHERE u.nombreusuario LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>{$row['idusuario']}</td>
        <td>{$row['nombrerol']}</td>
        <td>{$row['nombreusuario']}</td>
        <td>{$row['correousuario']}</td>
        <td>{$row['telefonousuario']}</td>
        <td>{$row['direccionusuario']}</td>
        <td>{$row['usuario']}</td>
        <td>";
        if ($row['idrol'] == 3) {
            echo "<button class='btn btn-sm btn-secondary custom-button-size cliente' data-id='{$row['idusuario']}'>Cambiar</button>";
        };
        echo "    </td>
        <td>";
        if ($row['idrol'] == 2) {
            echo "<button class='btn btn-sm btn-secondary custom-button-size empleado' data-id='{$row['idusuario']}'>Cambiar</button>";
        };
        echo "    </td>
      </tr>";
    }
} else {
    echo "<tr><td colspan='10' class='text-center'>No se encontraron resultados</td></tr>";
}
$conn->close();
