<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 16:53
 */

/**
 * Wzorzec projektowy - Singleton - popularny kiedyś
 *  - ogranicza mozliwosc tworzenia obieków klasy do jednej instancji
 *  - gdy potrzebny jest jeden obiekt koordynujacy dzialania w calym systemie
 *  - przyklad: potrzebujemy obiektu do polaczenia z baza danych, rózne komponenty aplikacji korzystja z tej samej instancji połączenia aby nie tworzyc za kazdym razem nowego połaczenia
 *  - często naduzywany
 *  - uwazany za anty-wzorzec
 *  - wprowadza globalny stan do aplikacji - globalna zmienna systemowa
 *  - trudności w testowaniu aplikacji - testy jednostkowe
 *  - nalezy ostroznie korzystac, sa sytuacje ze jest on niezbedny
 */

final class DbConnection
{
    private static $instance;

    private function __construct()
    {

    }

    public static function getInstance()
    {
        if (!self::$instance) {                    //sprawdza czy istnieje instacja bieżącej klasy
            self::$instance = new self();        // jeżeli nie to tworzy nową instancję
        }
        return self::$instance;                  // zwraca utworzona instancje klasy
    }

    private function __clone()                  // magiczna metoda clona stała się prywatna dzieki temu nie mozna klonowac klasy
    {

    }
}

$db1 = DbConnection::getInstance();
$db2 = DbConnection::getInstance();

print_r($db1 === $db2);  //sprawdzam czy zmienne posiadają identyczna instancje klasy Bdconnection  = TRUE

