<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $usuario = $_SESSION['usuario'];

  // Eliminar solo si pertenece al usuario
  $sql = "DELETE FROM notas WHERE id = ? AND usuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("is", $id, $usuario);
  $stmt->execute();
}

header('Location: privado.php'); // Regresar a la zona privada
exit;
?>