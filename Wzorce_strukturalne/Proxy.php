<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 17.10.2018
 * Time: 17:51
 */

/**
 * wzorzec projektowy - Proxy
 * - jest pośrednikiem, pełnomocnikiem
 * - to klasa reprezentujaca funkcjonalnosci innej klasy
 * - klasa ktora jest interfejsem do zewnetrznej klasy - pliki , zdalny zasób, jakis duży obiekt w pamięci
 * - klient korzysta z proxy tak jak z realnego obiektu
 * - moze zapewniac dodatkowa funkcjonalnosc
 * - moze kontrlowac dostep do klasy
 * - moze odpowiadac za cachowanie zawartosci
 *Przykład
 * - system ladowania obrazkow
 * - klasa realnego obrazka odpowiada za fizyczne ladowanie pliku z dysku
 * - klient uzywa proxy, ktore dodaje funkcjonalnosci cache, dzieki temu nie musimy obrazka wczytywac od nowa jesli klient zazada ponownie tego samego obrazka
 *
 */
interface Image
{
    public function render();
}

/**
 * Class RealImage - klasa realnego obrazka
 */
class RealImage implements Image
{
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->loadImage();
    }

    public function loadImage()
    {
        echo 'Ladowanie pliku obrazka ' . $this->filename . '<br>';
    }

    public function render()
    {
        echo 'Zawartość obrazka ' . $this->filename;
    }
}

/**
 * Class ProxyImage - zastosowanie proxy - obrazek laduje sie z dysku raz
 */
class ProxyImage implements Image
{
    private $image;
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function render()
    {
        if ($this->image == null) {
            $this->image = new RealImage($this->filename);
        }
        return $this->image->render();
    }
}

/**
 * kod od strony klienta
 */
$image = new ProxyImage('image2x');

echo $image->render() . '<br>';
echo $image->render() . '<br>';
echo $image->render() . '<br>';
