<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_donante = $_POST['id_donante'] ?? null;
    $id_proyecto = $_POST['id_proyecto'] ?? null;
    $monto = $_POST['monto'] ?? null;
    $fecha = $_POST['fecha'] ?? null;

    if ($id_donante && $id_proyecto && $monto && $fecha) {
        try {
            $sql = "INSERT INTO DONACION (monto, fecha, id_proyecto, id_donante) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$monto, $fecha, $id_proyecto, $id_donante]);
            header("Location: index.php?donacion=ok");
            exit;
        } catch (PDOException $e) {
            error_log("Error al insertar donación: " . $e->getMessage());
            header("Location: index.php?error=bd");
            exit;
        }
    } else {
        header("Location: index.php?error=faltan_datos");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>