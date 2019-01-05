<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 15:22
 */

/**
 * wzorzec projektowy --- Prototyp - klonowanie obiektów istniejacych
 *  - pozwala unikać wysokich kosztów związanych z inicjalizacją nowego obiektu - uzycie new
 *  - klonowanie obiektów
 *  - potrzebny jest prototyp obiektu
 *  - istnieją różne mechanizmy klonowania! (płytkie klonowanie, głębokie klonowanie)
 *  - gdy obiekt trochę rózni się od obiektu istniejącego to nalezy użyc metody clone()
 */

class  Pizza
{
    protected $size;
    protected $price;

    public function  __construct($size, $price)
    {
        $this->size = $size;
        $this->price =$price;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}

// sposob standardowy z uzyciem new do stworzenia nowej instacji klasy pizza
$pizza = new Pizza(30, 16.99);
print_r($pizza);

// używam klonowania zamiast new do tworzenia nowego obiektu
$clonedPizza = clone $pizza;
$clonedPizza->setPrice(18.99);

echo '<br/>';
 print_r($clonedPizza);


