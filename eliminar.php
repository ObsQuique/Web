<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM productos WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  header("Location: privado.php");
} else {
  echo "Error: " . $conn->error;
}
?>