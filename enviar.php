<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre  = htmlspecialchars($_POST['nombre']);
    $correo  = htmlspecialchars($_POST['correo']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $destinatario = "q7579403@gmail.com";
    $asunto = "Nuevo mensaje desde el formulario de contacto";
    $contenido = "Nombre: $nombre\nCorreo: $correo\nMensaje:\n$mensaje";

    $headers = "From: $correo\r\n";
    $headers .= "Reply-To: $correo\r\n";

    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "<script>alert('Mensaje enviado correctamente ✅'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Error al enviar el mensaje ❌'); window.location.href='index.html';</script>";
    }
}
?>
