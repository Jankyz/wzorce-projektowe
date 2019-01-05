<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 19:59
 */

/**
 * wzorzec projektowy - Fasada - opakowanie
 * - widzimy tylko zewnętrzna fasade ale nie widzimy co jest w srodku
 * - fasada ukrywa przed klientem zlozonosc systemow
 * - opakowuje zlozony system w prosty interfejs
 * - Ważne!! jezeli zmienimy cos w systemie to trzeba rowniez zmodyfikowac fasade
 * Przykład
 *  - skomplikowany system zamówien
 *  - do przygotowanai zamowienia potrzebne sa zloznoe obiekty (produkt, klient, platnosc, wysyłka)
 *  - fasada umozliwa latwa prace z zamowieniami, zapewnia interfejs ukrywajacy zlozonosc powyzszych obiektow
 */

/**
 * Class Product
 */
class Product
{
    public function getProduct()
    {
        return 'Produkt';
    }
}

/**
 * Class Payment
 */
class Payment
{
    public function makePayment()
    {
        return true;
    }
}

/**
 * Class Customer
 */
class Customer
{
    public function getCustomerData()
    {
        return 'Dane zamawiającego';
    }
}

/**
 * Class OrderFacade
 */
class OrderFacade
{
    protected $product;
    protected $payment;
    protected $customer;

    public function __construct()
    {
        $this->product = new Product();
        $this->payment = new Payment();
        $this->customer = new Customer();
    }

    public function prepareOrder()
    {
        $this->product->getProduct();
        $this->payment->makePayment();
        $this->customer->getCustomerData();

        return 'Zamowienie przygotowane';
    }
}

/**
 * kod Klienta
 */
$order = new OrderFacade();
echo $order->prepareOrder();