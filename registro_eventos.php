<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Evento</title>
</head>
<body>
  <h2>Registrar Nuevo Evento</h2>
  <form action="procesar_evento.php" method="POST">
    <label>Descripción:</label>
    <input type="text" name="descripcion" required><br>
    <label>Tipo de Evento:</label>
    <input type="text" name="tipo" required><br>

    <label>Lugar:</label>
    <input type="text" name="lugar" required><br>

    <label>Fecha:</label>
    <input type="date" name="fecha" required><br>

    <label>Hora:</label>
    <input type="time" name="hora" required><br>

    <button type="submit">Registrar</button>
  </form>
</body>
</html>