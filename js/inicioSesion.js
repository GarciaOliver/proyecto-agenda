function verificarInicioSesion(){
    var usuario= $('#usuario').val();
    var clave= $('#clave').val();

    if(usuario=='' || clave==''){
        alert('Ingrese todos los campos');
    }else{
        $.ajax({
            type:"POST",
            url:"../controlador/inicioSesionControlador.php",
            data:{usuario:usuario,
                clave:clave
            },
            success: function(datos) {
                if(datos==true){
                    window.location.href = '../vistas/inicio.php';
                }else{
                    alert("No ingreso");
                }
            }
        });
    }
}