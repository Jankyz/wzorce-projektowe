<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 27.10.2018
 * Time: 18:41
 */
/**
 * wzorzec projektowy - Mediator - Pośrednik
 * - pośredniczy w komunikacji pomiędzy obiektami
 * - zapewnia jednolity interfejs dla różnych elementów w danym podsystemie
 * - mediator to jedyna klasa, ktora zna wszystkie metody innych klas, jedyna klasa która zapenia komunikację pomiedzy innymi klasami, ma wiedze o innych klasach
 * Przykład
 * - chat webowy
 * - mediator to pośrednik, który umożliwia wysyłanie wiadomości pomiedzy userami -  klasa User
 * - mediator zna metody klasy User
 */

interface ChatMediator
{
    public function sendMessage($user, $message);
}

class ChatMediatorClass implements ChatMediator
{
    public function sendMessage($user, $message)
    {
        $sender = $user->getName();
        echo '<b>Nadawca:</b> ' . $sender . ' <b>Wiadomość:</b> ' . $message;
    }
}

class User
{
    private $name;
    private $chatMediator;

    public function __construct($name, $chatMediator)
    {
        $this->name = $name;
        $this->chatMediator = $chatMediator;
    }

    public function getName()
    {
        return $this->name;
    }

    public function send($message)
    {
        $this->chatMediator->sendMessage($this, $message);
    }
}

/**
 * kod klienta
 */

$mediator = new ChatMediatorClass();
$pawel = new User('Paweł', $mediator);
$tomek = new User('Tomek', $mediator);

$pawel->send('Co słychać Tomek?');
echo '<br>';
$tomek->send('W porządku Paweł!');