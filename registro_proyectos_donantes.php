<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Donantes y Proyectos</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .formulario {
      margin-bottom: 30px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      max-width: 600px;
      background-color:rgb(255, 255, 255);
    }
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 900px;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ccc;
      padding: 10px;
    }
    th {
      background-color: #eee;
    }
    .mensaje-exito {
      color: green;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <h1><i class="fas fa-database"></i> Registrar Proyectos y Donantes</h1>

  <div class="formulario">
    <h2><i class="fas fa-clipboard-list"></i> Registrar Proyecto</h2>
    <form action="procesar_proyecto.php" method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" required><br>

      <label>Descripción:</label>
      <input type="text" name="descripcion" required><br>

      <label>Presupuesto:</label>
      <input type="number" name="presupuesto" required><br>

      <label>Fecha Inicio:</label>
      <input type="date" name="fecha_inicio" required><br>

      <label>Fecha Fin:</label>
      <input type="date" name="fecha_fin" required><br>

      <button type="submit">Registrar Proyecto</button>
    </form>
  </div>

  <div class="formulario">
    <h2><i class="fas fa-user-plus"></i> Registrar Donante</h2>

    <?php if (isset($_GET['donante']) && $_GET['donante'] === 'ok'): ?>
      <p class="mensaje-exito"><i class="fas fa-check-circle"></i> Donante registrado correctamente.</p>
    <?php endif; ?>

    <form action="procesar_donante.php" method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" required><br>

      <label>Email:</label>
      <input type="email" name="email" required><br>

      <label>Dirección:</label>
      <input type="text" name="direccion" required><br>

      <label>Teléfono:</label>
      <input type="text" name="telefono" required><br>

      <button type="submit">Registrar Donante</button>
    </form>
  </div>

  <!-- Tabla de Proyectos -->
  <h2><i class="fas fa-list"></i> Proyectos Registrados</h2>
  <?php
  $proyectos = $conn->query("SELECT * FROM PROYECTO")->fetchAll(PDO::FETCH_ASSOC);
  if (count($proyectos) > 0): ?>
    <table>
      <tr>
        <th>ID</th><th>Nombre</th><th>Descripción</th><th>Presupuesto</th><th>Inicio</th><th>Fin</th>
      </tr>
      <?php foreach ($proyectos as $p): ?>
        <tr>
          <td><?= $p['id_proyecto'] ?></td>
          <td><?= htmlspecialchars($p['nombre']) ?></td>
          <td><?= htmlspecialchars($p['descripcion']) ?></td>
          <td><?= $p['presupuesto'] ?></td>
          <td><?= $p['fecha_inicio'] ?></td>
          <td><?= $p['fecha_fin'] ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No hay proyectos registrados aún.</p>
  <?php endif; ?>

  <br><a href="index.php" class="boton-secundario"><i class="fas fa-arrow-left"></i> Volver a la página principal</a>

</body>
</html>
      