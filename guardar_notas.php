<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['nota'])) {
    $nota = $_POST['nota'];
    $usuario = $_SESSION['usuario'];

    // Usar sentencia preparada
    $stmt = $conn->prepare("INSERT INTO notas (usuario, nota) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $nota);

    if ($stmt->execute()) {
      header("Location: privado.php");
      exit;
    } else {
      echo "Error al guardar la nota: " . $conn->error;
    }

    $stmt->close();
  } else {
    echo "La nota no puede estar vacía.";
  }
}

$conn->close();
?>