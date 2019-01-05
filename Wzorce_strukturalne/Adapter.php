<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 18:37
 */

/**
 *  wzorzec projektowy - Adapter - Wrapper
 *  - jak sprawić zeby niekompatybilne klasy mogły ze soba współpracowac
 *  - współpraca pomiedzy klasami, interfejsami ktore nie sa kompatybilne
 *
 */

class Product
{
    protected $sku;
    protected $price;

    public function __construct($sku, $price)
    {
        $this->sku = $sku;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}

/**
 * Adapter
 */
class ProductAdapter
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function displaySku()
    {
        return $this->product->getSku();
    }

    public function displayPrice()
    {
        return $this->product->getPrice();
    }
}


/**
 * kod od strony Klienta
 */
$product = new Product('234567', 39.99);
$productAdapter = new  ProductAdapter($product); //tworzymy nowy adapter gdzie zmienna jest instancja klasy Product

echo $productAdapter->displaySku(); //klient nie jest kompatybilny z klasa Product, klasa nie posiada metody displaySku(), dopiero po stworzeniu adaptera dostępne sa metody displaySku i displayPrice
echo '<br>';
echo $productAdapter->displayPrice();