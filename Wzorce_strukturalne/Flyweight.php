<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 20:15
 */

/**
 * wzorzec projektowy - Waga musza - Pyłek
 * - wzorzec nastawiony na wydajnosc
 * - pylki sa niewielkie ale jest ich wiele i sa do siebie bardzo podobne
 * - wspóldzielenie wlasciwosci z podobnymi obiektami
 * - jesli pewne wlasciwosci sa wspolne to wystarcza jedna wspoldzielona instancja
 * - zastosowanie przy duzej ilosci podobnych do siebie obiektow
 * - zastosowanie w grach ( las z tysiecy drzew ), wzorzec pozwoli roznicowac wlasciwosci drzew
 * Przyklad
 * - system reprezentujacy ksztalty
 * - wszystkie ksztalty jednego typu np prostokat, roznia sie kolorem rozmiarem
 * - skoro sa jednego typu to mozemy je przechowywac w jednej instanci i wciaz zachowac odmienne cechy danego ksztaltu
 * - jedna instancja na wszystkie prostokąty itp.
 */

/**
 * Interface Shape
 */
interface Shape
{
    public function __construct($name, $color);
}

/**
 * Class BasicShape zastosowanie Flyweight (Pyłek)
 */
class BasicShape implements Shape
{
    private $name;
    private $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }
}
/**
 * Należy stworzyć fabryke do produkcji pułkow zeby nie byly tworzone przez new
 *
 * Class BasicShapeFactory
 */
class BasicShapeFactory
{
    private $instances = [];

    public function getBasicShape($name, $color)
    {
        if (!isset($this->instances[$name])) {
            $this->instances[$name] = new BasicShape($name, $color);
        }
        return $this->instances[$name];
    }

    public function countInstances()
    {
        return count($this->instances);
    }
}

/**
 * kod od strony klienta
 */
$factory = new BasicShapeFactory();

$shape = $factory->getBasicShape('Kwadrat', 'Zielony');
$shape = $factory->getBasicShape('Trójkąt', 'Czarny');
$shape = $factory->getBasicShape('Kwadrat', 'Czarny');
$shape = $factory->getBasicShape('Okrąg', 'Czarny');
$shape = $factory->getBasicShape('Okrąg', 'Czerwony');
$shape = $factory->getBasicShape('Okrąg', 'Zielony');

echo $factory->countInstances();