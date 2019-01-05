<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 30.10.2018
 * Time: 21:32
 */

/**
 * wzorzec projektowy - Visitor - Odbiedzający
 * - sposob na odeseparowanie algorytmu od obiektu na ktorym ten algorytm operuje
 * - mozemy latwo dodawac nowe operacje do obiektu bez koniecznosci modyfikowania jego struktury
 * - wyobrazmy sobie odwiedzajacego ktory ma pozwolenie na wykonywanie swoich dzialan
 * - klasa 'odwiedzajacego' ktora dodaje funkcje do obiektu
 * - obiekt musi go zaakceptowac
 * Przykład
 * - działy firmy to klasy ( dzial spozywczy, meblowy itp)
 * - Visitor to raport na temat sprzedazy
 * - dzial (klasa) musi akceptowac odwiedzajacego
 * - mozemy dzieki temu dodawac nowe raporty bez koniecznosci modyfikowania klas
 */

interface Department
{
    public function accept(SalesReport $salesReport);
}

class FoodDepartment implements Department
{
    public function accept(SalesReport $salesReport)
    {
        $salesReport->visitFoodDep($this);
    }
}

class FurnitureDepartment implements Department
{
    public function accept(SalesReport $salesReport)
    {
        $salesReport->visitFurnitureDep($this);
    }
}

/**
 * Odwiedzający
 */

interface SalesReport
{
    public function visitFoodDep(FoodDepartment $foodDepartment);
    public function visitFurnitureDep(FurnitureDepartment $furnitureDepartment);
}

class SalesReportForDepartment implements SalesReport
{
    public function visitFoodDep(FoodDepartment $foodDepartment)
    {
        echo 'Raport sprzedaży dla ';
        print_r($foodDepartment);
    }

    public function visitFurnitureDep(FurnitureDepartment $furnitureDepartment)
    {
        echo 'Raport sprzedaży dla ';
        print_r($furnitureDepartment);
    }
}

class CompactSalesReportForDepartment implements SalesReport
{
    public function visitFoodDep(FoodDepartment $foodDepartment)
    {
        echo 'Kompaktowy raport sprzedaży dla ';
        print_r($foodDepartment);
    }

    public function visitFurnitureDep(FurnitureDepartment $furnitureDepartment)
    {
        echo 'Kompaktowy raport sprzedaży dla ';
        print_r($furnitureDepartment);
    }
}

/**
 * kod Klienta
 */

$foodDep = new FoodDepartment();
$furnitureDep = new FurnitureDepartment();

$salesReport = new CompactSalesReportForDepartment();

$foodDep->accept($salesReport);
echo '<br>';
$furnitureDep->accept($salesReport);

