<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM productos WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Producto</title>
  <style>
    body {
      background-color: #121212;
      font-family: 'Montserrat', sans-serif;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background: #1e1e1e;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px #fb02d2;
      width: 400px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }
    .card h2 {
      margin-bottom: 20px;
      color: #fb02d2;
    }
    label {
      display: block;
      text-align: left;
      margin-top: 10px;
      font-weight: bold;
      color: #ccc;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 8px;
      border: none;
      background: #222;
      color: white;
      font-size: 14px;
    }
    .btn {
      margin-top: 20px;
      background-color: #fb02d2;
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      border: none;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background-color: #ff4de6;
    }
    .cancel {
      background-color: #444;
      margin-left: 10px;
    }
    .cancel:hover {
      background-color: #666;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: scale(0.95);}
      to {opacity: 1; transform: scale(1);}
    }
  </style>
</head>
<body>

  <div class="card">
    <h2>✏️ Editar Producto</h2>
    <form method="post" action="editar.php?id=<?php echo $id; ?>">
      <label>Producto:</label>
      <input type="text" name="producto" value="<?php echo $row['producto']; ?>" required>

      <label>Cantidad:</label>
      <input type="number" name="cantidad" value="<?php echo $row['cantidad']; ?>" required>

      <label>Precio:</label>
      <input type="text" name="precio" value="<?php echo $row['precio']; ?>" required>

      <button type="submit" class="btn">💾 Guardar cambios</button>
      <a href="privado.php" class="btn cancel">Cancelar</a>
    </form>
  </div>

</body>
</html>

<?php
// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $producto = $_POST['producto'];
  $cantidad = $_POST['cantidad'];
  $precio   = $_POST['precio'];

  $sql = "UPDATE productos SET producto='$producto', cantidad='$cantidad', precio='$precio' WHERE id=$id";
  if ($conn->query($sql) === TRUE) {
    header("Location: privado.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
