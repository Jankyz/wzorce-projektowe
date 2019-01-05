<?php

//wzorzec projektowy --- mała fabryka

class Vehicle1
{
    protected $name;

    public function getName()
    {
        return $this->name;
    }
}

class Car extends Vehicle1
{
    public function __construct($name)
    {
        $this->name = $name;
    }
}

class CarFactory1
{
    public static function createCar($name)
    {
        return new Car($name);
    }

}

$car = CarFactory1::createCar("Alfa");

echo $car->getName();