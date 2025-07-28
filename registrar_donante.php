<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Donante</title>
  <link rel="stylesheet" href="styles.css">
  <script>
    function validarDonante() {
      let nombre = document.forms["donanteForm"]["nombre"].value;
      let email = document.forms["donanteForm"]["email"].value;
      if (nombre == "" || email == "") {
        alert("Nombre y correo son obligatorios.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <h2>Registrar Donante</h2>
  <form name="donanteForm" action="procesar_donante.php" method="POST" onsubmit="return validarDonante();">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br>
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Dirección:</label><br>
    <input type="text" name="direccion"><br>
    <label>Teléfono:</label><br>
    <input type="text" name="telefono"><br>
    <button type="submit">Guardar Donante</button>
  </form>
</body>
</html>