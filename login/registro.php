<?php
require '../includes/conexion.php';
// Validar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombreusuario = trim($_POST['nombre_completo']);
    $correousuario = trim($_POST['correo_electronico']);
    $telefonousuario = trim($_POST['telefono']);
    $direccionusuario = trim($_POST['direccion']);
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);


    if (empty($nombreusuario) || empty($correousuario) || empty($telefonousuario) || empty($direccionusuario) || empty($usuario) || empty($contrasena)) {
        $response['success'] = false;
        $response['message'] = "Todos los campos son obligatorios.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();  // Salir para que no continúe procesando
    }
    
    if (!filter_var($correousuario, FILTER_VALIDATE_EMAIL)) {
        $response['success'] = false;
        $response['message'] = "El correo electrónico no es válido.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if (!preg_match('/^[9][0-9]{8}$/', $telefonousuario)) {
        $response['success'] = false;
        $response['message'] = "El número de teléfono debe comenzar con 9 y tener 9 dígitos.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    if (strlen($contrasena) < 6) {
        $response['success'] = false;
        $response['message'] = "La contraseña debe tener al menos 6 caracteres.";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    // Verificar si el usuario o correo ya existen
    $sql = "SELECT * FROM usuario WHERE usuario='$usuario' OR correousuario='$correousuario'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $response['success'] = false;
        $response['message'] = "El usuario o el correo electrónico ya están registrados";
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    
    // Si todo está bien, realizar el registro
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuario (idrol,nombreusuario, correousuario, telefonousuario, direccionusuario, usuario, contrasena)
            VALUES (2,'$nombreusuario', '$correousuario', '$telefonousuario','$direccionusuario', '$usuario', '$contrasena_hash')";
    
    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del usuario recién registrado
        $idusuario = $conn->insert_id;

        // Crear un nuevo pedido en la tabla pedido
        $sql_pedido = "INSERT INTO pedido (idusuario, estado) VALUES ($idusuario,0)";
        
        if ($conn->query($sql_pedido) === TRUE) {
            $response['success'] = true;
            $response['message'] = "Registro exitoso.";
        } else {
            $response['success'] = false;
            $response['message'] = "Error al crear el pedido: ".$conn->error;
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error al registrar: ".$conn->error;
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
    
}

$conn->close();
