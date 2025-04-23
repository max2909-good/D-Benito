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
// Obtener nombres de clientes
$usuario_sql = "SELECT idusuario, nombreusuario FROM usuario";
$usuario_result = $conn->query($usuario_sql);

// Variables para los filtros seleccionados previamente
$selected_category = isset($_POST['categoria']) ? $_POST['categoria'] : '';
$selected_status = isset($_POST['estado']) ? $_POST['estado'] : '';
$selected_usuario_id = isset($_POST['nombreusuario']) ? $_POST['nombreusuario'] : '';
$selected_date = isset($_POST['fecha']) ? $_POST['fecha'] : '';
?>
