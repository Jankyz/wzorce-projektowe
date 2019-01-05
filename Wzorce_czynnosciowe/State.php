<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 28.10.2018
 * Time: 21:47
 */

/**
 * wzorzec projektowy - State - Stan
 * - zmieniamy zachowanie obiektu w zaleznosci od jego wewnetrzengo stanu
 * - obiektowa implementacji tzw. 'automatu skonczonego'
 *   - koncepcja abstrakcyjna, rzecz ktora ma pewna ilosc predefiniowanych stanow i w zaleznosci od stanu w ktorym sie znajduje moga zmienic sie zachowania tej rzeczy
 * - bardziej przejzysty sposob na zmiane zachowania obiektu bez uzywania instrukcji IF/ SWITCH
 * - kazdy stan to osobna klasa
 * Przykład
 * - telefon ma dwa tryby pracy : standardowy i wyciszony
 * - w trybie stnd powiadomienia uruchamiaja dzwiek i wibracje
 * - w trybie wyciszonym to samo powiadomienie uruchamia tylko wibracje
 * - zachowanie powiadomien zmienia sie w zaleznosci od stanu obiektu - telefonu
 */

/**
 * prosty edytor do malowania - rozne stany pedzla
 */

interface BrushState
{
    public function paint();
}

class SmallBrushState implements BrushState
{
    public function paint()
    {
        echo 'Linia namalowana małym pędzlem<br>';
    }
}

class MediumBrushState implements BrushState
{
    public function paint()
    {
        echo 'Linia namalowana średnim pędzlem<br>';
    }
}

class BigBrushState implements BrushState
{
    public function paint()
    {
        echo 'Linia namalowana duzym pędzlem<br>';
    }
}

class PaintingCanvas
{
    protected  $state;
    
    public function __construct(BrushState $state)
    {
        $this->state = $state;
    }

    public function setState(BrushState $state)
    {
        $this->state = $state;
    }

    public function paintLine()
    {
        $this->state->paint();
    }
}

/**
 * kod Klienta
 */

$canvas = new PaintingCanvas(new SmallBrushState());
$canvas->paintLine();
$canvas->setState(new BigBrushState());
$canvas->paintLine();
$canvas->paintLine();
$canvas->paintLine();
$canvas->paintLine();
