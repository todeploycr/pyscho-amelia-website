<?php
// Evitar acceso directo
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    die('Acceso no permitido');
}

// Configuración
$destinatario = "psicoameliareyes@gmail.com";
$asunto = "Nuevo mensaje desde tu sitio web";

// Obtener datos del formulario
$nombre = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$telefono = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : 'No proporcionado';
$mensaje = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Validar campos obligatorios
if (empty($nombre) || empty($email) || empty($mensaje)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Por favor completa todos los campos obligatorios']);
    exit;
}

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email inválido']);
    exit;
}

// Crear el cuerpo del email
$cuerpo = "
Has recibido un nuevo mensaje desde tu sitio web:

Nombre: $nombre
Email: $email
Teléfono: $telefono

Mensaje:
$mensaje

---
Este mensaje fue enviado desde el formulario de contacto de tu sitio web.
";

// Configurar headers
$headers = "From: contacto@tudominio.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Enviar email
if (mail($destinatario, $asunto, $cuerpo, $headers)) {
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Mensaje enviado correctamente']);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error al enviar el mensaje']);
}
?>