<?php
session_start();
if (!isset($_SESSION['cedula'])) {
    header('Location: ../controlador/login.php'); // Redirige a la página de inicio de sesión si no hay sesión activa
    exit();
}

// Incluir la conexión
require_once "../config/conf.php";

// Obtener el nombre del cliente desde la base de datos
$cedula = $_SESSION['cedula'];
$conn = Fn_getConnect();
$sql = "SELECT NOMBRE FROM CLIENTE WHERE CEDULA = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $cedula);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$_SESSION['nombre'] = $data['NOMBRE'];
$stmt->close();
$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menú de Navegación - Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/paginaPrincipal.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Barra Lateral -->
        <div class="bg-primary text-white sidebar" id="sidebar">
            <div class="sidebar-heading">RedesTel</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-primary text-white">Inicio</a>
                <a href="#" class="list-group-item list-group-item-action bg-primary text-white">Perfil</a>
                <a href="#" class="list-group-item list-group-item-action bg-primary text-white">Historial</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-primary text-white">Cerrar Sesión</a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button class="btn btn-primary" id="menu-toggle">☰ Menu</button>
            <div class="container-fluid">
                <h1 class="mt-4">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</h1>
                <p>-------------</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="../public/jquery/jquery-3.7.1.js"></script>
    <script src="../js/paginaPrincipal.js"></script>
</body>
</html>
