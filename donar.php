<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $monto = floatval($_POST["monto"]);

    if ($monto > 0) {
        echo "<p>¡Gracias, $nombre! Su donación de \$$monto ha sido registrada exitosamente.</p>";
    } else {
        echo "<p>Por favor ingrese un monto válido.</p>";
    }
}