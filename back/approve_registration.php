<?php
/**
 * Script completo: usa PHPMailer vía SMTP (configuración proporcionada)
 * - Conexión MySQLi
 * - Generación de contraseña temporal
 * - Inserción en users y actualización de pending_registrations
 * - Envío de correo vía SMTP usando las credenciales indicadas
 *
 * Requisitos:
 *  - composer require phpmailer/phpmailer
 *  - extensión openssl habilitada en PHP
 *  - permisos de escritura en /tmp para logs (opcional)
 */

date_default_timezone_set('Europe/Madrid');

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* --- Configuración de base de datos --- */
$dbHost = 'localhost';
$dbUser = 'prueba';
$dbPass = 'prueba123';
$dbName = 'prueba';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    error_log("DB connection error: " . $conn->connect_error);
    die("Conexión fallida: " . $conn->connect_error);
}

/* --- Función de log simple --- */
function dbg($msg) {
    file_put_contents('/tmp/registro_debug.log', date('c') . " - " . $msg . PHP_EOL, FILE_APPEND);
}

/* --- Comprobación de parámetro id --- */
if (!isset($_GET['id'])) {
    echo "No se proporcionó id.";
    $conn->close();
    exit;
}

$id = (int) $_GET['id'];

/* --- Obtener email pendiente --- */
$stmt = $conn->prepare("SELECT email FROM pending_registrations WHERE id = ? AND status = 'pending'");
if (!$stmt) {
    dbg("Error prepare select: " . $conn->error);
    die("Error en la consulta.");
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    dbg("Solicitud no encontrada o ya aprobada para id: $id");
    echo "Solicitud no encontrada o ya aprobada.";
    $stmt->close();
    $conn->close();
    exit;
}

$row = $result->fetch_assoc();
$email = trim($row['email']);
dbg("Encontrado email: $email para id: $id");

/* Validar formato básico del email */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    dbg("Email inválido: $email");
    echo "Email inválido.";
    $stmt->close();
    $conn->close();
    exit;
}

/* --- Generar contraseña temporal --- */
try {
    $password = bin2hex(random_bytes(6)); // 12 caracteres hex
} catch (Exception $e) {
    dbg("Error generando contraseña: " . $e->getMessage());
    die("Error generando contraseña.");
}

/* --- Insertar usuario en tabla users --- */
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt_insert = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
if (!$stmt_insert) {
    dbg("Error prepare insert: " . $conn->error);
    echo "Error al preparar inserción de usuario.";
    $stmt->close();
    $conn->close();
    exit;
}
$stmt_insert->bind_param("ss", $email, $hashed_password);
$okInsert = $stmt_insert->execute();
dbg("Insert execute: " . ($okInsert ? 'OK' : 'FAIL') . " - error: " . $stmt_insert->error . " - affected_rows: " . $conn->affected_rows);

if (!$okInsert || $conn->affected_rows <= 0) {
    echo "Error al registrar usuario.";
    $stmt_insert->close();
    $stmt->close();
    $conn->close();
    exit;
}

/* --- Actualizar estado de la solicitud --- */
$stmt_update = $conn->prepare("UPDATE pending_registrations SET status = 'approved' WHERE id = ?");
if ($stmt_update) {
    $stmt_update->bind_param("i", $id);
    $stmt_update->execute();
    dbg("Update affected_rows: " . $stmt_update->affected_rows);
    $stmt_update->close();
} else {
    dbg("Error prepare update: " . $conn->error);
}

/* --- Envío de notificación vía PHPMailer usando SMTP proporcionado --- */
$mail = new PHPMailer(true);

try {
    // Configuración SMTP según bloque proporcionado por el usuario
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vistahub15@gmail.com';
    // La contraseña de aplicación se ha proporcionado con espacios; eliminamos espacios por seguridad
    $rawAppPass = 'mirm qxwd sily trfy';
    $appPass = str_replace(' ', '', $rawAppPass);
    $mail->Password   = $appPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Debug a fichero para diagnosticar problemas SMTP
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function($str, $level) {
        file_put_contents('/tmp/phpmailer_smtp.log', date('c') . " [$level] $str\n", FILE_APPEND);
    };

    // Opcional temporal para problemas SSL (no recomendado en producción)
    // $mail->SMTPOptions = [
    //     'ssl' => [
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //         'allow_self_signed' => true
    //     ]
    // ];

    // Remitente solicitado (se fija como Andrei) y destinatario: el email recuperado
    // Nota: algunos servidores SMTP requieren que Username y From coincidan; si falla, revisa logs en /tmp/phpmailer_smtp.log
    $mail->setFrom('bugaandrei1@gmail.com', 'Andrei');
    $mail->addAddress($email);

    // Contenido del correo
    $mail->isHTML(false);
    $mail->Subject = 'Registro Aprobado - Tu Contraseña';
    $mail->Body    = "Tu registro ha sido aprobado. Tu contraseña temporal es: $password\n\nPor favor cambia la contraseña al iniciar sesión.";

    dbg("Intentando enviar correo a $email vía SMTP (usuario: {$mail->Username})");
    $mail->send();
    dbg("Envío OK a $email");
    echo "Usuario registrado y correo enviado.";
} catch (Exception $e) {
    dbg("PHPMailer Error: " . $mail->ErrorInfo . " Exception: " . $e->getMessage());
    echo "Usuario registrado, pero error al enviar correo.";
}

/* --- Cierre de recursos --- */
$stmt_insert->close();
$stmt->close();
$conn->close();
?>