<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 17.10.2018
 * Time: 18:44
 */

/**
 * wzorzec projektowy - Polecenie - Command
 * - unikamy ścisłego wiązania klienta z odbiornikiem (innym obiektem)
 * - żądanie klienta trakotwane jest jako obiekt
 * - zapewnia mozliwosc parametryzacji zadania
 * - umozliwia kolejowanie i zapamietywanie zadan
 * - możemy latwo zaimplementowac wycofywanie zmian w naszej aplikacji
 * - uzywa sie tego w interfejsach uzytkownika ktore sa konfigurowalne, mozemy przypisac skroty klawiszowe do polecen w programie
 * Przykład
 * - silnik moze byc wlaczony lub wylaczony
 * - istnieje wspólny intefejs dla polecen
 * - nalezy przygotowac osobne klasy dla kazdego polecenia, ktore mozna przekazac do silnika
 * - klasa przelącznika umozliwia wybor wlasciwego polecenia
 *
 */

/**
 * Class Engine - odbiornik
 */
class Engine
{
    public function turnOn()
    {
        echo 'Silnik włączony pyr pyr pyr...';
    }

    public function turnOff()
    {
        echo 'Silnik wyłączony tsssss...';
    }
}

/**
 * Interface Command - Polecenie
 */
interface  Command
{
    public function execute();
}

/**
 * Class TurnOnEngine - klasa wlaczajaca silnik
 */
class TurnOnEngine implements Command
{
    private $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    public function execute()
    {
        $this->engine->turnOn();
    }
}

/**
 * Class TurnOnEngine - klasa wylaczajaca silnik
 */
class TurnOffEngine implements Command
{
    private $engine;

    public function __construct($engine)
    {
        $this->engine = $engine;
    }

    public function execute()
    {
        $this->engine->turnOff();
    }
}

/**
 * Class EngineSwitch
 */
class EngineSwitch
{
    public function useSwitch($command)
    {
        $command->execute();
    }
}

/**
 * kod klienta
 */
$engine = new Engine();
$engineswitch = new EngineSwitch();
$turnon = new TurnOnEngine($engine);
$turnoff = new TurnOffEngine($engine);

$engineswitch->useSwitch($turnon);
echo '<br>';
$engineswitch->useSwitch($turnoff);