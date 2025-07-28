<?php
include_once("Eventos.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento = new Evento(
        htmlspecialchars($_POST["descripcion"]),
        htmlspecialchars($_POST["tipo"]),
        htmlspecialchars($_POST["lugar"]),
        $_POST["fecha"],
        $_POST["hora"]
    );

    echo "<h2>Evento Registrado</h2>";
    echo "<ul>";
    $evento->mostrar();
    echo "</ul>"; 
}
?>