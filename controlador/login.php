<?php
session_start();
header('Content-Type: application/json');

require_once "../config/conf.php"; // Asegúrate de que esta ruta es correcta

// Obtener los datos del formulario
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$clave = isset($_POST['clave']) ? $_POST['clave'] : '';

if (empty($usuario) || empty($clave)) {
    echo json_encode(['success' => false, 'message' => 'Ingrese todos los campos']);
    exit();
}

// Conectar a la base de datos
$conn = Fn_getConnect();

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar y ejecutar el procedimiento almacenado
$stmt = $conn->prepare("CALL SP_LOGIN(?, @cedula, @rol, @hash_contrasenia)");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->close();

// Obtener los valores de salida
$result = $conn->query("SELECT @cedula AS cedula, @rol AS rol, @hash_contrasenia AS hash_contrasenia");
$row = $result->fetch_assoc();

if ($row['cedula'] !== null) {
    // Verificar la contraseña
    if (password_verify($clave, $row['hash_contrasenia'])) {
        $_SESSION['cedula'] = trim($row['cedula']);
        $_SESSION['rol'] = trim($row['rol']);
        echo json_encode(array(
            'success' => true,
            'rol' => trim($row['rol'])
        ));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Credenciales incorrectas'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Credenciales incorrectas'));
}

$conn->close();
?>
