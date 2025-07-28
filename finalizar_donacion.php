<?php
session_start();

if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
  $total = 0;
  foreach ($_SESSION['carrito'] as $item) {
    $total += $item['monto'];
  }
  $_SESSION['carrito'] = [];
  $mensaje = "¡Gracias por tu donación!";
  $detalle = "Tu aporte total fue de $" . number_format($total, 2);
} else {
  $mensaje = "No hay donaciones pendientes.";
  $detalle = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Donación finalizada</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f0f8f5;
      text-align: center;
      padding: 60px;
    }

    .mensaje {
      background: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      display: inline-block;
      animation: aparecer 1s ease-in-out;
    }

    .mensaje i {
      color: #2ecc71;
      font-size: 60px;
      margin-bottom: 20px;
      animation: latido 1.5s infinite;
    }

    @keyframes aparecer {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes latido {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.2); }
    }

    .mensaje h1 {
      color: #27ae60;
      font-size: 32px;
      margin-bottom: 10px;
    }

    .mensaje p {
      color: #444;
      font-size: 18px;
    }

    .volver {
      display: inline-block;
      margin-top: 25px;
      padding: 10px 20px;
      background: #3498db;
      color: white;
      border-radius: 10px;
      text-decoration: none;
    }

    .volver:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>
  <div class="mensaje">
    <i class="fas fa-check-circle"></i>
    <h1><?= $mensaje ?></h1>
    <p><?= $detalle ?></p>
    <a href="index.php" class="volver"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
  </div>
</body>
</html>