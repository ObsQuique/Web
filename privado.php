<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header('Location: login.html');
  exit;
}

include 'conexion.php'; // conexión a tu base de datos

// Obtener productos de la BD
$result = $conn->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Zona Privada</title>
  <style>
    body {
      background-color: #121212;
      color: white;
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background: #1e1e1e;
      padding: 15px;
      text-align: center;
      box-shadow: 0 0 10px #fb02d2;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    body {
  margin: 0;
  font-family: 'Montserrat', sans-serif;
  background: #121212;
  color: #fff;
  display: flex;
}

.sidebar {
  width: 250px;
  background: #1e1e1e;
  padding: 20px;
  border-right: 2px solid #fb02d2;
  height: 100vh;
  position: fixed;
  left: 0;
  top: 0;
  overflow-y: auto;
}

.sidebar h2 {
  color: #fb02d2;
  margin-bottom: 15px;
}

.sidebar ul {
  list-style: none;
  padding: 0;
}

.sidebar ul li {
  background: #2a2a2a;
  margin: 8px 0;
  padding: 10px;
  border-radius: 5px;
  transition: 0.3s;
}

.sidebar ul li:hover {
  background: #fb02d2;
  color: #000;
  cursor: pointer;
}
.btn-delete {
  background-color: #ff4d4d;
  color: white;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 12px;
}
.btn-delete:hover {
  background-color: #ff1a1a;
}

.logout-btn {
  margin-top: 20px;
  width: 100%;
  padding: 12px;
  background: linear-gradient(45deg, #fb02d2, #ff6ec7);
  border: none;
  border-radius: 8px;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.logout-btn:hover {
  transform: scale(1.05);
  background: linear-gradient(45deg, #ff6ec7, #fb02d2);
}

.main-content {
  margin-left: 270px;
  padding: 20px;
  flex: 1;
}

.save-btn {
  margin-top: 10px;
  padding: 12px 20px;
  background: #fb02d2;
  border: none;
  border-radius: 8px;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

.save-btn:hover {
  background: #ff6ec7;
  transform: scale(1.05);
}

    th, td {
      border: 1px solid #444;
      padding: 12px;
    }
    th {
      background-color: #333;
      color: #fb02d2;
    }
    tr:hover {
      background-color: #222;
    }
    .btn {
      background-color: #fb02d2;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      margin: 2px;
      display: inline-block;
      transition: background 0.3s ease;
    }
    .btn:hover {
      background-color: #ff4de6;
    }
    .form-card {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 15px #02fb8c;
      margin-top: 40px;
      text-align: left;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: none;
      background: #222;
      color: white;
    }
    .save-btn {
      background-color: #02fb8c;
      color: black;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      border: none;
    }
    .save-btn:hover {
      background-color: #00d46a;
    }
  </style>
</head>
<body>

  <header>
    <h1>Zona Privada 🔐</h1>
  </header>

  <div class="container">
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> 👋</h2>

    <!-- Tabla de productos con botones -->
    <table>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?php echo $row['producto']; ?></td>
        <td><?php echo $row['cantidad']; ?></td>
        <td><?php echo $row['precio']; ?></td>
        <td>
          <a href="editar.php?id=<?php echo $row['id']; ?>" class="btn">✏️ Editar</a>
          <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn">🗑️ Eliminar</a>
        </td>
      </tr>
      <?php } ?>
    </table>

    <!-- Formulario para añadir producto -->
    <div class="form-card">
      <h3>➕ Añadir nuevo producto</h3>
      <form method="post" action="agregar.php">
        <label>Producto:</label>
        <input type="text" name="producto" required>
        <label>Cantidad:</label>
        <input type="number" name="cantidad" required>
        <label>Precio:</label>
        <input type="text" name="precio" required>
        <button type="submit" class="save-btn">Guardar producto</button>
      </form>
    </div>

    <!-- Apartado de notas -->
    <div class="form-card">
      <h3>📝 Registrar notas</h3>
      <form method="post" action="guardar_notas.php">
        <textarea name="nota" placeholder="Escribe aquí tus notas, pendientes o registros rápidos..."></textarea>
        <button type="submit" class="save-btn">Guardar nota</button>
      </form>
    </div>
    <div class="sidebar" id="sidebar">
  <h2>📒 Notas Rápidas</h2>
  <ul>
    <?php
    // Mostrar notas del usuario
    include 'conexion.php';
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT * FROM notas WHERE usuario = ? ORDER BY fecha DESC LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  echo "<li>" 
      . htmlspecialchars($row['nota']) . 
      " <a href='eliminar_nota.php?id=" . $row['id'] . "' class='btn'>🗑️</a></li>";
}
    ?>
  </ul>

  <button class="logout-btn" onclick="cerrarSesion()">🚪 Cerrar Sesión</button>
  <script>
function cerrarSesion() {
  if (confirm("¿Seguro que quieres cerrar sesión?")) {
    window.location.href = "logout.php";
  }
}
</script>

</div>
  </div>

</body>
</html>