<?php
class Coche {
    private $color;
    private $marca;
    private $modelo;
    private $velocidad;

    public function __construct($marca, $modelo, $color) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->color = $color;
        $this->velocidad = 0;
    }

    public function acelerar() {
        if ($this->velocidad < 100) {
            $this->velocidad += 10;
            if ($this->velocidad > 100) $this->velocidad = 100;
            echo "El coche acelera a {$this->velocidad} km/h<br>";
        } else {
            echo "Velocidad máxima alcanzada (100 km/h).<br>";
        }
    }

    public function frenar() {
        if ($this->velocidad > 0) {
            $this->velocidad -= 10;
            if ($this->velocidad < 0) $this->velocidad = 0;
            echo "El coche frena a {$this->velocidad} km/h<br>";
        } else {
            echo "El coche ya está detenido.<br>";
        }
    }

    public function getVelocidad() {
        return $this->velocidad;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($nuevoColor) {
        $this->color = $nuevoColor;
    }

    public function info() {
        echo "Coche: {$this->marca} {$this->modelo}, Color: {$this->color}, Velocidad: {$this->velocidad} km/h<br>";
    }
}

class Cochera {
    public function pintar(Coche $coche, $nuevoColor) {
        $coche->setColor($nuevoColor);
        echo "El coche ha sido pintado de color $nuevoColor.<br>";
    }
}

echo "<h2>Ejercicio 2: Coche y Cochera</h2>";
$coche = new Coche("Toyota", "Corolla", "Rojo");
$coche->info();

$cochera = new Cochera();
$cochera->pintar($coche, "Azul");
$coche->info();


while ($coche->getVelocidad() < 100) {
    $coche->acelerar();
}


while ($coche->getVelocidad() > 0) {
    $coche->frenar();
}
?>
