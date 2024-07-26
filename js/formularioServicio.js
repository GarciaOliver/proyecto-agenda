function insertarFormulario(){
    var cedula=$('#cedula').val();
    var servicio= $('#servicio').val();
    var ciudad= $('#ciudad').val();
    var principal= $('#principal').val();
    var secundaria= $('#secundaria').val();
    var nrocasa= $('#nrocasa').val();
    var referencia= $('#referencia').val();

    if(cedula == '' || principal=='' || secundaria=='' || nrocasa == '' || referencia == ''){
        alert('Ingrese todos los campos');
    }else{
        $.ajax({
            type:"POST",
            url:"../controlador/formularioServicioControlador.php",
            data:{cedula:cedula,
                servicio:servicio,
                ciudad:ciudad,
                principal:principal,
                secundaria:secundaria,
                nrocasa:nrocasa,
                referencia:referencia
            },
            success: function(datos) {
                if(datos=true){
                    alert("Servicio registrado exitosamente");
                }else{
                    alert("Error en el registro de servicio");
                }
            }
        });
    }
}