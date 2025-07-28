<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $monto = $_POST["monto"];
  $fecha = $_POST["fecha"];
  $id_proyecto = $_POST["id_proyecto"];
  $id_donante = $_POST["id_donante"];

  $sql = "INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante)
          VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$monto, $fecha, $id_proyecto, $id_donante]);

  echo "<p>✅ Donación registrada correctamente.</p>";
  echo "<a href='registrar_donacion.php'>Volver</a>";
}
?>