<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Solo acepta POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Recibir datos
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Validar campos
if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Completa todos los campos requeridos']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// ====================================
// CONFIGURACIÓN GMAIL SMTP
// ====================================
$smtp_host = 'smtp.gmail.com';
$smtp_port = 587;
$smtp_username = 'infoprismaticacr@gmail.com'; // TU EMAIL DE GMAIL
$smtp_password = 'zcim chys ejbe fzyw'; // LA KEY DE 16 CARACTERES QUE GENERASTE
$from_email = 'infoprismaticacr@gmail.com';
$from_name = 'Amelia Reyes - Psicóloga';
$to_email = 'infoprismaticacr@gmail.com'; // EMAIL DONDE QUIERES RECIBIR LOS MENSAJES

try {
    // ============================================
    // EMAIL 1: PARA TI (notificación del mensaje)
    // ============================================
    $mail = new PHPMailer(true);
    
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtp_port;
    $mail->CharSet = 'UTF-8';
    
    // Destinatarios
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($to_email);
    $mail->addReplyTo($email, $name);
    
    // Contenido
    $mail->isHTML(false);
    $mail->Subject = 'Nuevo mensaje de contacto - ' . $name;
    $mail->Body = "Has recibido un nuevo mensaje desde tu sitio web.\n\n" .
                  "Nombre: $name\n" .
                  "Email: $email\n" .
                  "Teléfono: $phone\n\n" .
                  "Mensaje:\n$message";
    
    $mail->send();
    
    // ============================================
    // EMAIL 2: AUTO-RESPUESTA PARA EL CLIENTE
    // ============================================
    $mail->clearAddresses();
    $mail->clearReplyTos();
    
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($email, $name);
    $mail->addReplyTo($to_email, $from_name);
    
    $mail->Subject = 'Confirmación - Mensaje recibido';
    $mail->Body = "Hola $name,\n\n" .
                  "Gracias por contactarme. He recibido tu mensaje y te responderé a la brevedad posible.\n\n" .
                  "📝 Resumen de tu mensaje:\n$message\n\n" .
                  "Si tienes alguna urgencia, también puedes escribirme por WhatsApp al +506 6058 7256.\n\n" .
                  "Saludos cordiales,\n" .
                  "Amelia Reyes\n" .
                  "Psicóloga Clínica\n" .
                  "psicoameliareyes@gmail.com";
    
    $mail->send();
    
    // Éxito
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente']);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Error al enviar: ' . $mail->ErrorInfo
    ]);
}
?>