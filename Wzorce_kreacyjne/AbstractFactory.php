<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 13:08
 */

//wzorzec projektowy - Fabryka Abstrakcyjna

//Abstrakcyjna fabryka
abstract class UIFactory
{
    abstract function createButton();
    abstract function createMenu();
}

//Klasa fabryki Windows
class WindowsUIFactory extends UIFactory
{
    public function createButton()
    {
        return new WindowsButton();
    }

    function createMenu()
    {
        return new WindowsMenu();
    }
}
//Klasa fabryki Linux
class LinuxUIFactory extends UIFactory
{
    public function createButton()
    {
        return new LinuxButton();
    }

    function createMenu()
    {
        return new LinuxMenu();
    }
}

abstract class Button
{
    abstract function getName();
}

class WindowsButton extends Button
{
    public function getName()
    {
        return 'Przycisk Windows';
    }
}
class LinuxButton extends Button
{
    public function getName()
    {
        return 'Przycisk Linux';
    }
}

abstract class Menu
{
    abstract function getName();
}

class WindowsMenu extends Menu
{
    public function getName()
    {
        return 'Menu Windows';
    }
}
class LinuxMenu extends Menu
{
    public function getName()
    {
        return 'Menu Linux';
    }
}

$os = 'linux';
$uiFactory = null;

if ( $os == 'Windows')
{
    $uiFactory = new WindowsUIFactory();
}
else
{
    $uiFactory = new LinuxUIFactory();
}

$button = $uiFactory->createButton();
$menu = $uiFactory->createMenu();

print_r($button->getName());
echo '<br/>';
print_r($menu->getName());

