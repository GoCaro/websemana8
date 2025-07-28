<?php
class Evento {
  public $descripcion;
  public $tipo;
  public $lugar;
  public $fecha;
  public $hora;

  public function __construct($descripcion, $tipo, $lugar, $fecha, $hora) {
    $this->descripcion = $descripcion;
    $this->tipo = $tipo;
    $this->lugar = $lugar;
    $this->fecha = $fecha;
    $this->hora = $hora;
  }

  public function mostrar() {
    echo "<li><strong>$this->descripcion</strong><br>
          Tipo: $this->tipo | Lugar: $this->lugar | 
          Fecha: $this->fecha | Hora: $this->hora</li>";
  }

  public static function filtrarPorTipo($eventos, $tipo) {
    $encontrados = false;
    foreach ($eventos as $evento) {
      if (stripos($evento->tipo, $tipo) !== false) {
        $evento->mostrar();
        $encontrados = true;
      }
    }
    if (!$encontrados) {
        echo "<li>No se encontraron eventos del tipo: <em>$tipo</em></li>";
    }
  }
}
?>