<?php
class CuentaBancaria {
    private $titular;
    private $saldo;

    public function __construct($titular, $saldoInicial = 0) {
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
    }

    public function ingresar($cantidad) {
        if ($cantidad > 0) {
            $this->saldo += $cantidad;
            echo "Ingreso de $cantidad € realizado.<br>";
        } else {
            echo "La cantidad a ingresar debe ser positiva.<br>";
        }
    }

    public function retirar($cantidad) {
        if ($cantidad > 0 && $cantidad <= $this->saldo) {
            $this->saldo -= $cantidad;
            echo "Retirada de $cantidad € realizada.<br>";
        } else {
            echo "Operación no válida. Fondos insuficientes o cantidad incorrecta.<br>";
        }
    }

    public function consultarSaldo() {
        echo "El saldo actual de {$this->titular} es: {$this->saldo} €<br>";
    }
}


echo "<h2>Ejercicio 1: Cuenta Bancaria</h2>";
$cuenta = new CuentaBancaria("Miguel", 100); 
$cuenta->consultarSaldo();
$cuenta->ingresar(50);
$cuenta->consultarSaldo();
$cuenta->retirar(30);
$cuenta->consultarSaldo();
$cuenta->retirar(200); 
?>
