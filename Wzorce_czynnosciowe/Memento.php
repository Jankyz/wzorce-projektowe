<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 27.10.2018
 * Time: 18:56
 */
/**
 * wzorzec projektowy - Memento - Pamiątka
 * - zapamietujemy bieżacy stan obiektu
 * - tens stan mozna pozniej łatwo przywrocic
 * - przykład to cofanie zmian w edytorze
 * Przykład
 * - Kalkulator zapamietuje poprzedni wynik
 * - klasa Memento to mechanizm zapamietywania
 * - klasa Kalkulatora odwoluje sie do Memento jesli chce zapisac lub przywolac zapisany wynik
 */

class CalculatorMemento
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
}

class Calculator
{
    protected $result;

    public function sum($a, $b)
    {
        $this->result = $a + $b;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function saveResult()
    {
        return new CalculatorMemento($this->result);
    }

    public function restoreResult(CalculatorMemento $memento)
    {
        $this->result = $memento->getResult();
    }
}

/**
 * kod Klienta
 */

$calculator = new Calculator();
$calculator->sum(4,6);
$saveResult = $calculator->saveResult();

$calculator->sum(2,3);

echo 'Bieżący wynik: ' . $calculator->getResult() . '<br>';

$calculator->restoreResult($saveResult);

echo 'Poprzedni wynik: ' . $calculator->getResult() . '<br>';
