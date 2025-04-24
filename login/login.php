<?php
session_start();

// Configuración de errores
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log'); // Cambia esta ruta

require '../includes/conexion.php';

// Validar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion']) && $_POST['accion'] == 'login') {
        $usuario = trim($_POST['usuario']);
        $contrasena = trim($_POST['contrasena']);

        if (empty($usuario) || empty($contrasena)) {
            $response['success'] = false;
            $response['message'] = "Todos los campos son obligatorios.";
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } else {
            $sql = "SELECT * FROM usuario WHERE usuario='$usuario' OR correousuario='$usuario'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $contrasena_hash = $row['contrasena'];
                $idrol = $row['idrol'];

                if (password_verify($contrasena, $contrasena_hash)) {
                    $_SESSION['idusuario'] = $row['idusuario'];
                    $_SESSION['usuario'] = $row['usuario'];
                    $_SESSION['nombreusuario'] = $row['nombreusuario'];
                    $_SESSION['correousuario'] = $row['correousuario'];
                    $_SESSION['telefonousuario'] = $row['telefonousuario'];
                    $_SESSION['direccionusuario'] = $row['direccionusuario'];
                    $_SESSION['idrol'] = $idrol;

                    if ($idrol == 2) {
                        $response['redirect'] = '../pages/Principal.php';
                    } elseif ($idrol == 3 || $idrol == 1) {
                        $response['redirect'] = '../Administrador/Inicio/indexAdmi.php';
                    }

                    $response['success'] = true;
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                } else {
                    $response['success'] = false;
                    $response['message'] = "Contraseña incorrecta.";
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['success'] = false;
                $response['message'] = "El usuario o correo electrónico no existe.";
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }
        }
    } elseif (isset($_POST['accion']) && $_POST['accion'] == 'logout') {
        session_unset();
        session_destroy();
        header("Location: ../pages/Principal.php");
        exit();
    }
}

$conn->close();
?>
