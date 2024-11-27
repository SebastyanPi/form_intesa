<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener y limpiar los datos del formulario
    $tipo_documento = htmlspecialchars($_POST['tipo_documento']);
    $documento = htmlspecialchars($_POST['documento']);
    $expedida = htmlspecialchars($_POST['expedida']);
    $nacimiento = htmlspecialchars($_POST['nacimiento']);
    $lugar_nacimiento = htmlspecialchars($_POST['lugar_nacimiento']);
    $nombre_apellido = htmlspecialchars($_POST['nombre_apellido']);
    $municipio = htmlspecialchars($_POST['municipio']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $barrio = htmlspecialchars($_POST['barrio']);
    $celular = htmlspecialchars($_POST['celular']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $correo = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL);
    $genero = htmlspecialchars($_POST['genero_tipo']);
    $estrato = htmlspecialchars($_POST['estrato']);
    $estado_civil = htmlspecialchars($_POST['estado_civil']);
    $sisben = htmlspecialchars($_POST['sisben']);
    $eps = htmlspecialchars($_POST['eps']);
    $nivel = htmlspecialchars($_POST['nivel']);
    $ocupacion = htmlspecialchars($_POST['ocupacion']);
    $discapacidad = htmlspecialchars($_POST['discapacidad']);
    $talla = htmlspecialchars($_POST['talla']);
    $redes = htmlspecialchars($_POST['redes']);
    $sede = htmlspecialchars($_POST['sede']);
    $select_carrera = htmlspecialchars($_POST['select_carrera']);
    $carrera = htmlspecialchars($_POST['carrera']);
    $name_curso = htmlspecialchars($_POST['name_curso']);
    $nacionalidad = htmlspecialchars($_POST['nacionalidad']);

    // Verificar que los campos principales estén llenos
    if ($documento && $tipo_documento && $expedida && $nacimiento && $lugar_nacimiento && $nombre_apellido && $correo) {

        // Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "quoted-printable";
        $mail->SMTPDebug = 0; // Desactivar la depuración para producción

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP(); // Enviar utilizando SMTP
            $mail->Host       = 'smtp.hostinger.com'; // Servidor SMTP
            $mail->SMTPAuth   = true; // Habilitar autenticación SMTP
            $mail->Username   = 'inscripcion1@institutointesa.edu.co'; // Usuario SMTP
            $mail->Password   = 'Inscripcion1!Intesa2024'; // Contraseña SMTP
            $mail->SMTPSecure = 'ssl'; // Habilitar la encriptación TLS implícita
            $mail->Port       = 465; // Puerto para la conexión

            // Remitente y destinatarios
            $mail->setFrom('inscripcion1@institutointesa.edu.co', 'Inscripciones INTESA');
            $mail->addAddress('academia@institutointesa.edu.co'); // Primer destinatario
            $mail->addAddress('mipiro2016@gmail.com'); // Segundo destinatario

            // Contenido del correo
            $mail->isHTML(true); // Configurar el formato del correo como HTML
            $mail->Subject = "Nueva Inscripción - " . $nombre_apellido; // Asunto
            $mail->Body = "<strong>Tipo de Documento:</strong> $tipo_documento<br>";
            $mail->Body .= "<strong>Documento:</strong> $documento<br>";
            $mail->Body .= "<strong>Expedida en:</strong> $expedida<br>";
            $mail->Body .= "<strong>Nacionalidad:</strong> $nacionalidad<br>";
            $mail->Body .= "<strong>Nacimiento:</strong> $nacimiento<br>";
            $mail->Body .= "<strong>Lugar de Nacimiento:</strong> $lugar_nacimiento<br>";
            $mail->Body .= "<strong>Nombre Completo:</strong> $nombre_apellido<br>";
            $mail->Body .= "<strong>Municipio de Residencia:</strong> $municipio<br>";
            $mail->Body .= "<strong>Dirección:</strong> $direccion<br>";
            $mail->Body .= "<strong>Barrio:</strong> $barrio<br>";
            $mail->Body .= "<strong>Celular:</strong> $celular<br>";
            $mail->Body .= "<strong>Numero de Emergencia:</strong> $telefono<br>";
            $mail->Body .= "<strong>Correo:</strong> $correo<br>";
            $mail->Body .= "<strong>Género:</strong> $genero<br>";
            $mail->Body .= "<strong>Estrato:</strong> $estrato<br>";
            $mail->Body .= "<strong>Estado Civil:</strong> $estado_civil<br>";
            $mail->Body .= "<strong>Sisbén:</strong> $sisben<br>";
            $mail->Body .= "<strong>EPS:</strong> $eps<br>";
            $mail->Body .= "<strong>Nivel de Formación:</strong> $nivel<br>";
            $mail->Body .= "<strong>Ocupación:</strong> $ocupacion<br>";
            $mail->Body .= "<strong>Discapacidad:</strong> $discapacidad<br>";
            $mail->Body .= "<strong>Talla de Camisa:</strong> $talla<br>";
            $mail->Body .= "<strong>¿Por qué medio se enteró del Instituto?:</strong> $redes<br>";
            $mail->Body .= "<strong>Sede:</strong> $sede<br>";

            // Agregar información sobre la carrera o curso
            if ($select_carrera == "Tecnico") {
                $mail->Body .= "<strong>Carrera Técnica Laboral:</strong> $carrera<br>";
            } else {
                $mail->Body .= "<strong>Curso/Diplomado/Seminario:</strong> $name_curso<br>";
            }

            // Enviar el correo
            $mail->send();

            // Redirigir a la página de éxito
            header("Location: https://inscripcion.institutointesa.edu.co/exito.html");
            exit(); // Asegurar que no se ejecute más código

        } catch (Exception $e) {
            // Si ocurre un error, redirigir a la página de error
            header("Location: https://inscripcion.institutointesa.edu.co/fallo.html");
            exit(); // Asegurar que no se ejecute más código
        }

    } else {
        // Si faltan datos, redirigir a la página de error
        header("Location: https://inscripcion.institutointesa.edu.co/fallo.html");
        exit(); // Asegurar que no se ejecute más código
    }

} else {
    // Si no es un POST, redirigir a la página de error
    header("Location: https://inscripcion.institutointesa.edu.co/fallo.html");
    exit(); // Asegurar que no se ejecute más código
}
?>
