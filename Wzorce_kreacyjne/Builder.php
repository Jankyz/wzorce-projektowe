<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 14:49
 */

/**
 * wzorzec projektowy - Budowniczy, konstruktor, Bodowlaniec
 *  - wzorzec buduje obiekt etapami , dodaje informacje kiedy są potrzebne
 *  - przy tworzeniu roznych wariantów obiektu
 *  - konstruktos jest bardziej czytelny
 */

/**
 * Class Pizza - podejscie klasyczne bez uzycia Buildera
 */

class Pizza
{
    protected $size;

    protected $tomato = false;
    protected $extraCheese = false;
    protected $egg = false;
    protected $spinach = false;
    protected $bacon = false;

    public function __construct($PizzaBuilder)
    {
        $this->size =$PizzaBuilder->size;
        $this->tomato = $PizzaBuilder->tomato;
        $this->extraCheese = $PizzaBuilder->extraCheese;
        $this->egg = $PizzaBuilder->egg;
        $this->spinach = $PizzaBuilder->spinach;
        $this->bacon = $PizzaBuilder->bacon;
    }

    public function getName()
    {
        return 'Pizza';
    }
}

/**
 * Podeście z użyciem wzorca Builder
 */

class PizzaBuilder
{
    public $size;

    public $tomato = false;
    public $extraCheese = false;
    public $egg = false;
    public $spinach = false;
    public $bacon = false;

    public function __construct($size)
    {
        $this->size = $size;
    }

    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    public function addExtraCheese()
    {
        $this->extraCheese = true;
        return $this;
    }

    public function addEgg()
    {
        $this->egg = true;
        return $this;
    }

    public function addSpinach()
    {
        $this->spinach = true;
        return $this;
    }

    public function addBacon()
    {
        $this->bacon = true;
        return $this;
    }

    public function build()
    {
        return new Pizza($this);
    }
}

$pizza = (new PizzaBuilder('Small'))
                                ->addBacon()
                                ->addExtraCheese()
                                ->build();

print_r($pizza);


