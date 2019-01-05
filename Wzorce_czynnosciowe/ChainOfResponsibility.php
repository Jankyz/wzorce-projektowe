<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 17.10.2018
 * Time: 18:15
 */

/**
 * wzorzec projektowy - łańcuch odpowiedzialnosci - łańcuch zobowiazan
 * - to łańcuch obiektów
 * - klient wysyła żądanie, które jest obsłuzone przez "handler"
 * - żądanie przechodzi przez łańcuch dopóki nie trafi na wlasciwy handler
 * Przyklad
 * - w sklepie sa rozne procesory platnosci
 * - platnosci do 99zl obslugiwane prze PayPal
 * - platnosci do 100zł do 999zl realizowane przelewem
 * - platnosci od 1000zl w gore za pomoca karty
 * - klient zada przetworzenia platnosci i podaje kwote
 * - kazdy procesor to handler
 * - okreslamy w jakiej kolejnosci zostana ulozone procesory w lancuchu
 * - zadanie przejdzie przez lancuch az natrafi na procesor ktory jest w stanie przetworzyc dana kwote
 *
 */

/**
 * Class PaymentProcessor - klasa abstrakcyjna
 */
abstract class PaymentProcessor
{
    protected $successor = null; //nastepny procesor platnosci ktory zostanie wywyolany jesli poprzedni nie przetworzy zadania

    public function setSuccessor($paymentProcessor)
    {
        $this->successor = $paymentProcessor;
    }

    abstract public function processPayment($amount);
}

class PayPal extends PaymentProcessor
{
    public function processPayment($amount)
    {
        if ($amount >= 0 && $amount <= 99 ) {
            return 'Platnosci PayPal: ' . $amount;
        } else {
            if ($this->successor != null) {
                return $this->successor->processPayment($amount);
            }
            return 'Brak możliwosci obsługi tak wysokiej płatności!';
        }
    }
}

class BankTransfer extends PaymentProcessor
{
    public function processPayment($amount)
    {
        if ($amount >= 100 && $amount <= 999 ) {
            return 'Platnosci Przelewem: ' . $amount;
        } else {
            if ($this->successor != null) {
                return $this->successor->processPayment($amount);
            }
            return 'Brak możliwosci obsługi tak wysokiej płatności!';
        }
    }
}

class Card extends PaymentProcessor
{
    public function processPayment($amount)
    {
        if ($amount >= 1000 && $amount <= 5000) {
            return 'Platnosci Kartą Płatniczą: ' . $amount;
        } else {
            if ($this->successor != null) {
                return $this->successor->processPayment($amount);
            }
            return 'Brak możliwosci obsługi tak wysokiej płatności!';
        }
    }
}

/**
 * kod od strony klienta
 */

$pp = new PayPal();
$bt = new BankTransfer();
$cc = new Card();

$pp->setSuccessor($bt);
$bt->setSuccessor($cc);

echo $pp->processPayment(3500);