<?php
session_start(); // ✅ Inicia la sesión

// Datos del dueño
$usuario_correcto = "Jose Luis";
$clave_correcta = "1234";

// Datos recibidos del formulario
$usuario = $_POST['usuario'] ?? '';
$clave = $_POST['clave'] ?? '';

// Validación
if ($usuario === $usuario_correcto && $clave === $clave_correcta) {
    $_SESSION['usuario'] = $usuario; // ✅ Guarda el usuario en la sesión
    header('Location: privado.php'); // ✅ Redirige al área privada
    exit;
} else {
    // Mensaje de error
    echo "<body style='background-color:#121212; color:white; font-family:Montserrat; text-align:center;'>";
    echo "<h2 style='color:red;'>Usuario o contraseña incorrectos</h2>";
    echo "<a href='login.html' style='color:#fbc02d;'>← Volver al login</a>";
    echo "</body>";
}
?>