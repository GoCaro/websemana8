<?php
include("conexion.php");

$sql = "
SELECT p.nombre AS proyecto, COUNT(d.id_donacion) AS cantidad_donaciones, 
       SUM(d.monto) AS total_recaudado
FROM DONACION d
JOIN PROYECTO p ON d.id_proyecto = p.id_proyecto
GROUP BY p.id_proyecto
HAVING COUNT(d.id_donacion) > 2
ORDER BY total_recaudado DESC
";

$resultado = $conn->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resumen de Donaciones</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h2>Proyectos con más de 2 Donaciones</h2>
  <table border="1" cellpadding="8">
    <tr>
      <th>Proyecto</th>
      <th>Cantidad de Donaciones</th>
      <th>Total Recaudado (USD)</th>
    </tr>
    <?php foreach ($resultado as $fila): ?>
    <tr>
      <td><?= $fila['proyecto'] ?></td>
      <td><?= $fila['cantidad_donaciones'] ?></td>
      <td><?= number_format($fila['total_recaudado'], 2) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>