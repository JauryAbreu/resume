<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $to = 'cercanati@gmail.com';
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $subject = strip_tags(trim($_POST["subject"]));
  $message = trim($_POST["message"]);

  if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    http_response_code(400);
    echo "Por favor complete correctamente todos los campos.";
    exit;
  }

  $email_content = "Nombre: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Mensaje:\n$message\n";

  $headers = "From: $name <$email>";

  if (mail($to, $subject, $email_content, $headers)) {
    echo "Su mensaje ha sido enviado exitosamente.";
  } else {
    http_response_code(500);
    echo "Hubo un error al enviar el mensaje. Inténtelo más tarde.";
  }
} else {
  http_response_code(403);
  echo "Método no permitido.";
}
?>
