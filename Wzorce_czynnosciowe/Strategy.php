<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 30.10.2018
 * Time: 21:06
 */
/**
 * wzorzec projektowy - Strategy - Strategia
 * - podobny do wzorca Stan
 * - wybieramy strategie w zalezonosci od sytuacji
 * - mamy zestaw klas w ktorym kazda klasa reprezentuje okreslone zachowanie
 * - wybor jakiejs klasy zmnienia zachowanie programu
 * - to klient dokonuje wybory odpowiedniej strategii
 * - Stan mozna sobie wyobrazic jako rzecz np. jaki jest biezacy stan jakiegos obiektu
 * - Strategia to bardziej czynnosć - obiekt ktory cos robi
 * - Strategi oraz stan maja podobna strukture ale odmienne zamierzenia
 * Przykład
 * - rozne algorytmy sortujace ( Quick sort, Insertion Sort itp)
 * - kazdy algorytm jest zoptymaluzowany do sortowania innych danych
 * - klient moze wybrac wlasciwa strategie (odpowiedni algorytm sortowania)
 * - raz wykonujemy sortowanie wybierajac odpowiednia strategię!
 *
 */

interface SortStrategy
{
    public function sort($list);
}

class QuickSortStrategy implements SortStrategy
{
    public function sort($list)
    {
        echo 'Lista posortowana za pomocą Quick sort';
        return $list;
    }
}

class BucketSortStrategy implements SortStrategy
{
    public function sort($list)
    {
        echo 'Lista posortowana za pomocą Bucket sort';
        return $list;
    }
}

class InsertionSortStrategy implements SortStrategy
{
    public function sort($list)
    {
        echo 'Lista posortowana za pomocą Insertion sort';
        return $list;
    }
}

class SortingComponent
{
    protected $sortingStrategy;

    public function __construct(SortStrategy $sortingStrategy)
    {
        $this->sortingStrategy = $sortingStrategy;
    }

    public function sortList($list)
    {
        return $this->sortingStrategy->sort($list);
    }
}

/**
 * kod Klienta
 */
$list = [1,2,3,4,5];
$sortingComponent = new SortingComponent(new QuickSortStrategy());
$sortingComponent->sortList($list);

echo '<br>';

$sortingComponent = new SortingComponent(new BucketSortStrategy());
$sortingComponent->sortList($list);
