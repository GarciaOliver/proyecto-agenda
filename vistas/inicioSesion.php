<?php
session_start();
if (isset($_SESSION['nombreUsuario']) && isset($_SESSION['clave']))
    session_destroy();
?>

<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de Sesión</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .text-center {
            background-color: rgb(2, 73, 155);
        }

        h1 {
            color: white;
        }
    </style>
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <img class="mb-4" src="../public/recursos/logo-redestel.jpeg" alt="logo-redestel" width="200" height="150">
        <h1>Inicio de Sesión</h1>
        <div class="form-floating">
            <input type="email" class="form-control" id="usuario" name="clave">
            <label for="floatingInput">Correo Electrónico o Cédula</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="clave" name="clave">
            <label for="floatingPassword">Contraseña</label>
        </div>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" onclick="verificarInicioSesion()">Ingresar</button><br>
        <button class="w-100 btn btn-lg btn-primary" onclick="">Registrar</button>
    </main>

</body>

</html>