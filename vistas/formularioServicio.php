<?php
session_start();
if(isset($_SESSION['datos']['cedula'])){

?>

<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Servicio</title>
    
    <script src="../public/jquery/jquery-3.7.1.js"></script>
    <script src="../js/formularioServicio.js"></script>
</head>

<body class="text-center">
    <div class="container mt-5">
        <div class="mb-3">
            <label class="form-label">Cedula del cliente*</label>
            <input type="text" id="cedula" name="cedula">
        </div>
        <div class="mb-3">
            <label class="form-label">Tipo de servicio*</label>
            <select class="form-select" name="servicio" id="servicio">
                <option value="inalambrico">Inalámbrico</option>
                <option value="fibra">Fibra Óptica</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad*</label>
            <select class="form-select" name="ciudad" id="ciudad">
                <option value="ibarra">Ibarra</option>
                <option value="pimampiro">Pimampiro</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Calle principal*</label>
            <input type="text" id="principal" name="principal">
        </div>
        <div class="mb-3">
            <label class="form-label">Calle secundaria</label>
            <input type="text" id="secundaria" name="secundaria">
        </div>
        <div class="mb-3">
            <label class="form-label">Número de casa*</label>
            <input type="text" id="nrocasa" name="nrocasa">
        </div>
        <div class="mb-3">
            <label class="form-label">Referencia*</label>
            <input type="text" id="referencia" name="referencia">
        </div>
        <div class="mb-3">
            <input type="button" value="Ingresar" onclick="insertarFormulario()">
        </div>
    </div>

</body>

</html>

<?php
}else{
    header("Location: inicioSesion.php");
}
?>