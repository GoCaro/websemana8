<?php
session_start();
unset($_SESSION['carrito']); // Elimina el carrito completo
header("Location: ver_carrito.php");
exit();
?>