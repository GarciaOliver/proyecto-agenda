<?php
require '../vendor/autoload.php';
require '../config/conf.php'; // Asegúrate de que esta ruta es correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


try {
    // Obtener datos del formulario
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $contrasenia = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);
    $estado = 1; // Valor del estado

    // Verificar si el correo ya está registrado
    $sql = "SELECT COUNT(*) AS count FROM CLIENTE WHERE CORREO = '$correo'";
    $resultado = ejecutarConsultaSP($sql);
    $row = $resultado->fetch_assoc();
    $count = $row['count'];

    if ($count > 0) {
        echo 'El correo electrónico ya está registrado.';
    } else {
        // Generar un hash único para la activación de la cuenta
        $hash = bin2hex(random_bytes(16));

        // Insertar el cliente en la base de datos
        $sql = "INSERT INTO CLIENTE (CEDULA, NOMBRE, NROTELEFONO, CONTRASENIA, CORREO, ESTADO, hash_) VALUES ('$cedula', '$nombre', '$telefono', '$contrasenia', '$correo', $estado, '$hash')";
        $result = ejecutarConsultaSP($sql);

        if ($result) {
            // Enviar el correo de activación
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'kevinteran750@gmail.com'; // Tu dirección de correo de Gmail
                $mail->Password   = 'fyiz cylj qbhn bzfq'; // Tu contraseña de aplicación de Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usa SSL
                $mail->Port       = 465; // Puerto para SSL

                $mail->setFrom('kevinteran750@gmail.com', 'RedesTel');
                $mail->addAddress($correo, $nombre);

                $mail->isHTML(true);
                $mail->Subject = 'Activa tu cuenta';
                $mail->Body    = '
                    <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                line-height: 1.6;
                            }
                            .container {
                                max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                border: 1px solid #ddd;
                                border-radius: 5px;
                                background-color: #f9f9f9;
                            }
                            .button {
                                display: inline-block;
                                padding: 10px 20px;
                                font-size: 16px;
                                color: #fff;
                                background-color: #007bff;
                                text-decoration: none;
                                border-radius: 5px;
                            }
                            .footer {
                                font-size: 14px;
                                color: #555;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="container">
                            <h2>¡Hola ' . htmlspecialchars($nombre) . '!</h2>
                            <p>Gracias por registrarte en <strong>RedesTel</strong>. Para completar el proceso de registro, por favor activa tu cuenta haciendo clic en el siguiente enlace:</p>
                            <p><a href="http://192.168.1.100/proyecto-agenda/controlador/Activar.php?hash=' . htmlspecialchars($hash) . '" class="button">Activar mi cuenta</a></p>
                            <p>Si no te registraste en nuestro sitio, por favor ignora este correo electrónico.</p>
                            <p>Si tienes algún problema o necesitas asistencia, no dudes en contactarnos.</p>
                            <p>¡Gracias y bienvenido a <strong>RedesTel</strong>!</p>
                            <p class="footer">Este es un correo electrónico automático, por favor no respondas a este mensaje.</p>
                        </div>
                    </body>
                    </html>
                ';
                $mail->AltBody = 'Hola ' . htmlspecialchars($nombre) . ',\n\nGracias por registrarte en RedesTel. Para completar el proceso de registro, por favor activa tu cuenta haciendo clic en el siguiente enlace: http://192.168.1.100/proyecto-agenda/controlador/Activar.php?hash=' . htmlspecialchars($hash) . '\n\nSi no te registraste en nuestro sitio, por favor ignora este correo electrónico.\n\nGracias y bienvenido a RedesTel!';

                $mail->send();
                echo 'El correo de activación ha sido enviado.';
            } catch (Exception $e) {
                echo "No se pudo enviar el correo. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo 'Error al registrar el cliente.';
        }
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
