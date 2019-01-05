<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 19:17
 */

/**
 * wzorzec projektowy Dekorator
 * - pozwala dynamicznie zmienic zachowanie obiektu pakujac go w inny obiekt
 * - umozliwa dodawanie nowych zachowan do wskazanego obiekty nie modyfikujac jednoczesnie innych obiektów tego samego typu
 * - mamy jakis obiekt i mozemy go dekorowac zeby go zmienic
 * - dodajemy na obiekcie ktory tego dekoratora wymaga
 * Przykład
 * - mamy mechanizm tworzenia okien w interfejsie
 * - definiujemy klase bazowego okna, bez dodatkowych elementów
 * - definiujemy dekoratory ktore dekoruja dodajac paski przewijanai nagłowki itp.
 * - pakujemy bazowe okan w obiekt dekoratora jesli zajdzie potrzeba
 */

/**
 * Interface Window
 */
interface Window
{
    public function renderWindow();
}

/**
 * Class BasicWindow
 */
class BasicWindow implements Window
{
    public function renderWindow()
    {
        return 'Zawartość okna';
    }
}
/**
 * Tworzymy dekoratory
*/

interface WindowDecorator
{
    public function renderWindow();
    public function __construct($window);
}

/**
 * Class ScrollbarDecorator
 */
class ScrollbarDecorator implements WindowDecorator
{
    protected $window;

    public function __construct($window)
    {
        $this->window = $window;
    }

    public function renderWindow()
    {
        return $this->window->renderWindow() . '<br>' . $this->renderScrollbar();
    }

    public function renderScrollbar()
    {
        return 'Pasek przewijania';
    }

}
class HeaderDecorator implements WindowDecorator
{
    protected $window;

    public function renderWindow()
    {
        return $this->renderHeader() . '<br>' . $this->window->renderWindow();
    }

    public function renderHeader()
    {
        return 'Header okna';
    }

    public function __construct($window)
    {
        $this->window = $window;
    }
}


$window = new BasicWindow();
$window = new ScrollbarDecorator($window);
$window = new HeaderDecorator($window);

echo $window->renderWindow();
