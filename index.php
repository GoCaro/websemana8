<?php
ini_set('session.cookie_httponly', 1);
session_start();

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
    session_regenerate_id(true);
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Organización sin fines de lucro</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <header>
    <h1><i class="fas fa-hand-holding-heart"></i> Organización Solidaria</h1>
    <nav>
      <a href="#donaciones"><i class="fas fa-donate"></i> Donar</a>
      <a href="#eventos"><i class="fas fa-calendar-alt"></i> Eventos</a>
      <a href="#registro"><i class="fas fa-edit"></i> Registrar Evento</a>
      <a href="#logros"><i class="fas fa-bullhorn"></i> Logros y Campañas</a>
      <a href="registro_proyectos_donantes.php"><i class="fas fa-users-cog"></i> Registrar Donantes y Proyectos</a>
    </nav>

    <div id="notificacion" class="modal">
      <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModal()">&times;</span>
        <h3><i class="fas fa-hand-holding-heart"></i> ¡Gracias por visitarnos!</h3>
        <p>Te invitamos a donar y sumarte a nuestras campañas solidarias. Cada aporte cuenta. 💚</p>
      </div>
    </div>

    <script>
      window.onload = function () {
        document.getElementById('notificacion').style.display = 'block';
      };

      function cerrarModal() {
        document.getElementById('notificacion').style.display = 'none';
      }
    </script>
  </header>

  <main>
    <!-- Sección de Donaciones -->
    <section id="donaciones">
      <h2><i class="fas fa-donate"></i> Realiza tu Donación</h2>
      <img src="imagenes/donacion.jpg" alt="Imagen de donación" style="width:100%;max-width:600px;border-radius:10px;">

      <?php
      include("conexion.php");

      $proyectos = $conn->query("SELECT id_proyecto, nombre FROM PROYECTO")->fetchAll(PDO::FETCH_ASSOC);
      $donantes = $conn->query("SELECT id_donante, nombre FROM DONANTE")->fetchAll(PDO::FETCH_ASSOC);
      ?>

<?php if (isset($_GET['donacion']) && $_GET['donacion'] == 'ok'): ?>
  <p class="mensaje-exito"><i class="fas fa-check-circle"></i> Donación registrada correctamente.</p>
<?php elseif (isset($_GET['error'])): ?>
  <p class="mensaje-error"><i class="fas fa-exclamation-circle"></i> Error al procesar la donación.</p>
<?php endif; ?>

      <form action="guardar_donacion.php" method="POST">
        <label for="id_donante">Selecciona el Donante:</label>
        <select name="id_donante" required>
          <option value="">-- Elige un Donante --</option>
          <?php foreach ($donantes as $d): ?>
            <option value="<?= $d['id_donante'] ?>"><?= htmlspecialchars($d['nombre']) ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="id_proyecto">Selecciona el Proyecto:</label>
        <select name="id_proyecto" required>
          <option value="">-- Elige un Proyecto --</option>
          <?php foreach ($proyectos as $p): ?>
            <option value="<?= $p['id_proyecto'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
          <?php endforeach; ?>
        </select><br>

        <label for="monto">Monto (USD):</label>
        <input type="number" name="monto" min="1" step="any" required><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br>

        <button type="submit">Donar</button>
      </form>
    </section>
<!-- Botón para ver el reporte de donaciones -->
<div style="text-align: center; margin-top: 40px;">
  <a href="reporte_donaciones.php" class="boton-secundario" style="padding: 10px 20px; background-color: #27ae60; color: white; text-decoration: none; border-radius: 8px;">
    <i class="fas fa-chart-line"></i> Ver Reporte de Donaciones
  </a>
</div>

    <!-- Botón para registrar proyectos y donantes -->
<div style="margin-top: 20px;">
  <a href="registro_proyectos_donantes.php" class="boton-secundario">
    <i class="fas fa-plus-circle"></i> Registrar Donante y Proyecto
  </a>
</div>
<!-- Sección de Filtrado y Visualización de Eventos -->
<section id="eventos">
      <h2><i class="fas fa-calendar-alt"></i> Buscar y Filtrar Eventos</h2>
      <form method="GET" action="index.php">
        <label for="tipo">Filtrar por tipo de evento:</label>
        <input type="text" name="tipo" placeholder="Ej: solidario">
        <button type="submit">Buscar</button>
      </form>

      <ul>
        <?php
          include_once("eventos.php");

          $eventos = [
            new Evento("Reunión comunitaria", "social", "Sede Central", "2025-07-10", "18:00"),
            new Evento("Taller de reciclaje", "educativo", "Escuela Verde", "2025-07-12", "10:00"),
            new Evento("Campaña de alimentos", "solidario", "Plaza Mayor", "2025-07-15", "14:00"),
          ];

          $tipoBuscado = isset($_GET["tipo"]) ? trim($_GET["tipo"]) : "";

          if ($tipoBuscado !== "") {
            Evento::filtrarPorTipo($eventos, $tipoBuscado);
          } else {
            foreach ($eventos as $evento) {
              $evento->mostrar();
            }
          }
          ?>
      </ul>
    </section>

<!-- Sección de Registro de Eventos -->
<section id="registro">
      <h2><i class="fas fa-edit"></i> Registrar un Nuevo Evento</h2>
      <img src="imagenes/evento.jpg" alt="Registrar evento" style="width:100%;max-width:600px;border-radius:10px;">
      <form action="procesar_evento.php" method="POST">
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" required><br>

        <label for="tipo">Tipo de Evento:</label>
        <input type="text" name="tipo" required><br>

        <label for="lugar">Lugar:</label>
        <input type="text" name="lugar" required><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required><br>

        <button type="submit">Registrar</button>
      </form>
    </section>

   <!-- Sección de Notificaciones de Logros y Campañas -->
   <section id="logros">
      <h2><i class="fas fa-bullhorn"></i> Logros Recientes y Campañas Activas</h2>
      <img src="imagenes/logros.jpg" alt="Imagen de logros" style="width:100%;max-width:600px;border-radius:10px;">
      <ul>
        <li><strong><i class="fas fa-check-circle"></i> Meta alcanzada:</strong> 100 kits escolares entregados en la zona rural.</li>
        <li><strong><i class="fas fa-seedling"></i> Reforestación:</strong> 200 árboles nativos plantados.</li>
        <li><strong><i class="fas fa-hand-holding-usd"></i> Campaña activa:</strong> Fondos para el comedor solidario de invierno.</li>
        <li><strong><i class="fas fa-running"></i> Invitación:</strong> Participa del maratón solidario este 20 de julio.</li>
      </ul>
    </section>
  </main>

  </main>

  <footer>
    <p>&copy; 2025 Organización Solidaria - Todos los derechos reservados.</p>
  </footer>
</body>
</html>