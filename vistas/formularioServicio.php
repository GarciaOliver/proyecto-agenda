<?php
session_start();
if(isset($_SESSION['datos'])){

?>

<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Servicio</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    
    <script src="../public/jquery/jquery-3.7.1.js"></script>
    <script src="../js/inicioSesion.js"></script>
</head>

<body class="text-center">

    

</body>

</html>

<?php
}else{
    header("Location: inicioSesion.php");
}
?>