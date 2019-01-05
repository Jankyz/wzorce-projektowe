<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 13:39
 */

//wzorzec projektowy --- metoda wytwórcza

interface Vehicle
{
    public function getName();
}

class Bicycle implements Vehicle
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Car implements Vehicle
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

// Fabryka pojazdów
interface VehicleFactory
{
    public function create($name);
}
//Fabryka Samochodów
class CarFactory implements VehicleFactory
{
    public function create($name)
    {
        return new Car($name);
    }
}
//Fabryka Rowerów
class BicycleFactory implements VehicleFactory
{
    public function create($name)
    {
        return new Bicycle($name);
    }
}

$carFactory = new CarFactory();
$car = $carFactory->create('Alfa Romeo');
echo $car->getName();
