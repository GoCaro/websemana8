<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Proyecto</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function validarFormulario() {
      let nombre = document.forms["proyectoForm"]["nombre"].value;
      let presupuesto = document.forms["proyectoForm"]["presupuesto"].value;
      if (nombre == "" || presupuesto == "") {
        alert("Todos los campos obligatorios deben completarse.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <h2>Registrar Proyecto</h2>
  <form name="proyectoForm" action="procesar_proyecto.php" method="POST" onsubmit="return validarFormulario();">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br>
    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br>
    <label>Presupuesto:</label><br>
    <input type="number" name="presupuesto" step="0.01" required><br>
    <label>Fecha de Inicio:</label><br>
    <input type="date" name="fecha_inicio"><br>
    <label>Fecha de Fin:</label><br>
    <input type="date" name="fecha_fin"><br>
    <button type="submit">Guardar Proyecto</button>
  </form>
</body>
</html>