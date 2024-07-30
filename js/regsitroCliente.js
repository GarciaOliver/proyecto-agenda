function registrar(){
    var cedula=$('#cedula').val();
    var nombre=$('#nombre').val();
    var nrotelefono=$('#nrotelefono').val();
    var correo=$('#correo').val();
    var contrasena=$('#contrasena').val();

    if(cedula=='' || nombre=='' || nrotelefono=='' || correo=='' || contrasena==''){
        alert("Ingrese todos los campos")
    }else{
        $.ajax({
            type:"POST",
            url:"../controlador/registroClienteControlador.php",
            data:{cedula:cedula,
                nombre:nombre,
                nrotelefono:nrotelefono,
                correo:correo,
                contrasena:contrasena
            },
            success: function(datos) {
                if(datos==true){
                    alert("Cliente registrado exitosamente");
                }else{
                    alert("Error en el registro del cleinte");
                }
                /*if(datos=true){
                    window.location.href = '../vistas/formularioServic.php';
                }else{
                    alert("Correo o contraseña incorrecta");
                }*/
            }
        });
    }
}