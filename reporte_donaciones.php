<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Donaciones por Proyecto</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    table {
      width: 80%;
      margin: 30px auto;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }

    h1 {
      text-align: center;
      margin-top: 40px;
    }

    .volver {
      text-align: center;
      margin-top: 20px;
    }

    .volver a {
      background-color: #3498db;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
    }

    .volver a:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

<h1><i class="fas fa-chart-bar"></i> Proyectos con más de 2 Donaciones</h1>

<?php
$sql = "
  SELECT 
    p.nombre AS nombre_proyecto,
    COUNT(d.id_donacion) AS total_donaciones,
    SUM(d.monto) AS monto_total
  FROM PROYECTO p
  JOIN DONACION d ON p.id_proyecto = d.id_proyecto
  GROUP BY p.id_proyecto
  HAVING total_donaciones > 2
  ORDER BY monto_total DESC
";

$stmt = $conn->query($sql);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if (count($resultados) > 0): ?>
  <table>
    <tr>
      <th>Proyecto</th>
      <th>Cantidad de Donaciones</th>
      <th>Monto Total Recaudado (USD)</th>
    </tr>
    <?php foreach ($resultados as $fila): ?>
      <tr>
        <td><?= htmlspecialchars($fila['nombre_proyecto']) ?></td>
        <td><?= $fila['total_donaciones'] ?></td>
        <td>$<?= number_format($fila['monto_total'], 2) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p style="text-align:center;">No hay proyectos con más de 2 donaciones todavía.</p>
<?php endif; ?>

<div class="volver">
  <a href="index.php"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
</div>

</body>
</html>