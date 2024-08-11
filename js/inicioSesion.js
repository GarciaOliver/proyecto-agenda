function verificarInicioSesion() {
    var usuario = $('#usuario').val();
    var clave = $('#clave').val();

    if (usuario === '' || clave === '') {
        alert('Ingrese todos los campos');
    } else {
        $.ajax({
            type: "POST",
            url: "../controlador/login.php",
            data: {
                usuario: usuario,
                clave: clave
            },
            dataType: 'json',
            success: function (datos) {
                if (datos.success) {
                    // Redirigir según el rol del usuario
                    switch (datos.rol) {
                        case 'CLIENTE':
                            window.location.href = '../vistas/paginaPrincipal.php';
                            break;
                        case 'SOPORTE':
                            window.location.href = '../vistas/menuSoporte.php';
                            break;
                        case 'TECNICO':
                            window.location.href = '../vistas/menuTecnico.php';
                            break;
                        default:
                            alert('Rol de usuario desconocido.');
                            break;
                    }
                } else {
                    alert(datos.message);
                }
            },
            error: function (xhr, status, error) {
                alert('Ocurrió un error al procesar la solicitud: ' + error);
            }
        });
    }
}
