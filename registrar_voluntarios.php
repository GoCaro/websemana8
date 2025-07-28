<?php
// Formulario básico para registrar voluntarios
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Voluntario</title>
</head>
<body>
  <h2>Formulario de Registro de Voluntarios</h2>
  <form action="procesar_voluntario.php" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required><br><br>

    <label>Correo:</label>
    <input type="email" name="correo" required><br><br>

    <label>Disponibilidad:</label>
    <input type="text" name="disponibilidad"><br><br>

    <button type="submit">Registrar</button>
  </form>
</body>
</html>