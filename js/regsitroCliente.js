function registrar() {
    var cedula = $('#cedula').val();
    var nombre = $('#nombre').val();
    var telefono = $('#telefono').val();
    var correo = $('#correo').val();
    var contrasenia = $('#contrasenia').val();

    if (cedula === '' || nombre === '' || telefono === '' || correo === '' || contrasenia === '') {
        alert("Ingrese todos los campos");
    } else {
        $.ajax({
            type: "POST",
            url: "../controlador/registroClienteControlador.php",
            data: {
                cedula: cedula,
                nombre: nombre,
                telefono: telefono,
                correo: correo,
                contrasenia: contrasenia
            },
            success: function(response) {
                if (response === 'El correo electrónico ya está registrado.') {
                    alert("El correo electrónico ya está registrado.");
                } else if (response === 'El correo de activación ha sido enviado.') {
                    alert("Cliente registrado exitosamente. Por favor, revisa tu correo para activar tu cuenta.");
                } else {
                    alert("Error en el registro del cliente.");
                }
            },
            error: function() {
                alert("Hubo un problema con la solicitud.");
            }
        });
    }
}
