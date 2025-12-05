<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php'; // archivo donde configuras tu conexión a MySQL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $producto = $_POST['producto'];
  $cantidad = $_POST['cantidad'];
  $precio   = $_POST['precio'];

  $sql = "INSERT INTO productos (producto, cantidad, precio) VALUES ('$producto', '$cantidad', '$precio')";
  if ($conn->query($sql) === TRUE) {
    header("Location: privado.php");
  } else {
    echo "Error: " . $conn->error;
  }
}
?>