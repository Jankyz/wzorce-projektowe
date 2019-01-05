<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 17.10.2018
 * Time: 19:13
 */
/**
 * wzorzec projektowy - Iterator
 * - przetwarzanie kolekcji - kontenera (pętla przetwarzająca kolekcje- lista plików, użytkowników itp)
 * - dostęp do elementow obiektu od strony klienta bez ujawniania jego wewnetrznych mechanizmów
 * - kolekcja (kontener) moze byc przetwarzany za pomocą iteratora
 * Przykład z zycia
 * - odtwarzacz mp3
 * - lista piosenek to kolekcja
 * - przycisk następny/poprzeni nas interesuje
 * - nie interesuje nas jak wew mechanizmy dzialaja
 * Przykład praktyczny
 * - kolekcja elementów menu
 * - PHP udostepnia wbudowanych interfejs Iteratora
 * - należy zaimplementować ten interfejs
 * - musimy także stworzyć klasę kolekcji - zbiór elementów z Menu
 *
 */

/**
 * Class MenuItemsIterator
 */
class MenuItemsIterator implements Iterator
{
    private $menuItems;
    private $index = 0;

    public function __construct(MenuItemsCollection $menuItems)
    {
        $this->menuItems = $menuItems;
    }

    public function current()
    {
        return $this->menuItems->getItem($this->index);
    }

    public function next()
    {
        return $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return !is_null($this->menuItems->getItem($this->index));
    }

    public function rewind()
    {
        return $this->index = 0;
    }
}

/**
 * Class MenuItemsCollection
 */
class MenuItemsCollection implements IteratorAggregate
{
    private $items = [];

    public function getIterator()
    {
        return new MenuItemsIterator($this);
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }

    public function getItem($key)
    {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
        return null;
    }
}
/**
 * kod klienta
 */
$menuItems = new MenuItemsCollection();
$menuItems->addItem('Start');
$menuItems->addItem('Wiadomości');
$menuItems->addItem('Osoby');

foreach ($menuItems as $menuItem) {
    echo $menuItem . '<br>';
}
