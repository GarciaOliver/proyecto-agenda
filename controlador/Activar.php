<?php
require '../config/conf.php'; // Asegúrate de que esta ruta es correcta

// Obtener el hash de la URL
if (!isset($_GET['hash'])) {
    die('Hash no proporcionado.');
}

$hash = $_GET['hash'];

try {
    // Obtener la conexión
    $conexion = Fn_getConnect();

    // Preparar y ejecutar la consulta para verificar el hash
    $sql = "SELECT * FROM CLIENTE WHERE hash_ = ? AND ACTIVADO = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $hash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die('Hash inválido o ya activado.');
    }

    // Activar la cuenta
    $sql = "UPDATE CLIENTE SET ACTIVADO = 1 WHERE hash_ = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $hash);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'Cuenta activada exitosamente. Ahora puedes iniciar sesión.';
    } else {
        echo 'Hubo un problema al activar la cuenta.';
    }

    $stmt->close();
    $conexion->close();
} catch (Exception $e) {
    die('Error: ' . $e->getMessage());
}
?>
