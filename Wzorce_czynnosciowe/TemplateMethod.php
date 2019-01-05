<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 30.10.2018
 * Time: 21:18
 */

/**
 * wozrzec projektowy - Template method - Metoda szablonowa - dosc czesto uzywany
 * - szkielet algorytmu okresla glowne etapy/kroki
 * - w jakiej kolejnosci kroki maja byc wykonane
 * - implementacja poszczególnych etapach jest realizowana w klasach dziedziczacych
 * - szablon operacji ktorej szczegoly implementujemy w klasach dziedziczacych
 * Przykład
 * - klasa zapytan do bazy danych
 * - zapytanie zawsze ma te same kroki ( przygotuj wyslij odbierz rezultat)
 * - rozne implementacje kroków dla roznych typow bazy - MySQL, NoSQL, MongoDB itp.)
 * ----
 * - abstrakcyjna klasa zapytania do bazy danych definiujaca abstrakcyjne metody (kroki opreacji)
 * - ta sama klasa zawiera met szablonowa ktora okresla w jakiej kolejnosci te kroki maja byc wykonane
 * - klasy dziedziczace implementuja poszczegolne kroki
 */

abstract class  DatabaseQuery
{
    abstract public function prepareQuery();
    abstract public function sendQuery();
    abstract public function getResult();

    //metoda szablonowa wymusza okreslona kolejnosc wykonywania kroków
    final public function getDataFromDB()
    {
        $this->prepareQuery();
        $this->sendQuery();
        $this->getResult();
    }
}

class MysqlQuery extends DatabaseQuery
{
    public function prepareQuery()
    {
        echo 'Przygotowuje zapytanie dla bazy MySQL<br>';
    }

    public function sendQuery()
    {
        echo 'Wysyłam zapytanie dla bazy MySQL<br>';
    }

    public function getResult()
    {
        echo 'Odbieram dane z bazy MySQL<br>';
    }
}

class MongoDBQuery extends DatabaseQuery
{
    public function prepareQuery()
    {
        echo 'Przygotowuje zapytanie dla bazy MongoDB<br>';
    }

    public function sendQuery()
    {
        echo 'Wysyłam zapytanie dla bazy MongoDB<br>';
    }

    public function getResult()
    {
        echo 'Odbieram dane z bazy MongoDB<br>';
    }
}

/**
 * kod Klienta
 */

$mysqlQuery = new MysqlQuery();
$mysqlQuery->getDataFromDB();

$mongoDbQuery = new MongoDBQuery();
$mongoDbQuery->getDataFromDB();