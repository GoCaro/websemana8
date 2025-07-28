<?php
session_start();

if (!isset($_SESSION['carrito'])) {
  $_SESSION['carrito'] = [];
}

$campania = isset($_POST['campania']) ? $_POST['campania'] : '';
$monto = isset($_POST['monto']) ? floatval($_POST['monto']) : 0;

if ($campania !== '' && $monto > 0) {
  $_SESSION['carrito'][] = [
    'campania' => $campania,
    'monto' => $monto
  ];
}

// Redirige a ver el carrito
header("Location: ver_carrito.php");
exit();
?>
