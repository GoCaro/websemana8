<?php
include("conexion.php");

// Consultar proyectos y donantes existentes
$proyectos = $conn->query("SELECT id_proyecto, nombre FROM PROYECTO")->fetchAll();
$donantes = $conn->query("SELECT id_donante, nombre FROM DONANTE")->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Donación</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Registrar Donación</h2>
  <form action="procesar_donacion.php" method="POST">
    <label>Monto (USD):</label><br>
    <input type="number" name="monto" step="0.01" required><br>

    <label>Fecha:</label><br>
    <input type="date" name="fecha" required><br>

    <label>Proyecto:</label><br>
    <select name="id_proyecto" required>
      <option value="">-- Seleccione --</option>
      <?php foreach ($proyectos as $proyecto): ?>
        <option value="<?= $proyecto['id_proyecto'] ?>"><?= $proyecto['nombre'] ?></option>
      <?php endforeach; ?>
    </select><br>

    <label>Donante:</label><br>
    <select name="id_donante" required>
      <option value="">-- Seleccione --</option>
      <?php foreach ($donantes as $donante): ?>
        <option value="<?= $donante['id_donante'] ?>"><?= $donante['nombre'] ?></option>
      <?php endforeach; ?>
    </select><br>

    <button type="submit">Guardar Donación</button>
  </form>
</body>
</html>