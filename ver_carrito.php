<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de Donaciones</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <h1><i class="fas fa-shopping-cart"></i> Carrito de Donaciones</h1>

  <?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    <ul>
      <?php
      $total = 0;
      foreach ($_SESSION['carrito'] as $item) {
        echo "<li><strong>{$item['campania']}</strong> - \$" . number_format($item['monto'], 2) . "</li>";
        $total += $item['monto'];
      }
      ?>
    </ul>
    <p><strong>Total donado:</strong> $<?= number_format($total, 2) ?></p>

<!-- Botones para vaciar o finalizar -->
<form action="vaciar_carrito.php" method="POST" style="display:inline;">
  <button type="submit" class="btn-rojo" onclick="return confirm('¿Estás segura/o de vaciar el carrito?')">
    <i class="fas fa-trash-alt"></i> Vaciar carrito
  </button>
</form>

<form action="finalizar_donacion.php" method="POST" style="display:inline; margin-left: 10px;">
  <button type="submit" class="btn-verde" onclick="return confirm('¿Deseas finalizar la donación?')">
    <i class="fas fa-check-circle"></i> Finalizar donación
  </button>
</form>

<?php else: ?>
    <p>No hay donaciones en el carrito aún.</p>
  <?php endif; ?>

  <br><br>
  <a href="index.php"><i class="fas fa-arrow-left"></i> Volver a la página principal</a>