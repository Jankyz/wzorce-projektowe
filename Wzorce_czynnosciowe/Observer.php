<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 27.10.2018
 * Time: 19:22
 */

/**
 * wzorzec projektowy - Observer - Obserwator
 * - jesli zmienia sie stan obiektu to obiekty zalezne zostana o tym powiadomione
 * - obiekt obserwowany przechowuje liste obserwatorow
 * - obiekt obserwowany powiadamia swoich obserwatorów w momencie gdy zmieni sie jego stan
 * - obserwator otrzymuje powidamienie i moze na nie zareagowac ale nie musi
 * Przykład
 * - prosty system powiadomien - obiekt oserwowany to Usługa Powiadomien
 * - obserwatorzy to Subskruybenci
 * - Usługa Powiadomień moze przygotowac wiadomosc i wyslac ja do Subskrybentów
 * - Subskrybent moze zareagowac w momencie otrzymanai wiadomosci
 *
 */

/**
 * Interface Observable - obiekt obserwowalny - musi posiadac jakas liste obserwatorow
 */
interface Observable
{
    public function addObserver(Subscriber $subscriber);
    public function notifyObservers(Message $message);
}

/**
 * Interface Observer
 */
interface Observer
{
    public function __construct($name);
}

/**
 * Class Message
 */
class Message
{
    protected $content;

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }
}

/**
 * Class - obiekt obserwowany - powiadomienia
 */
class NotificationService implements Observable
{
    protected $subscribers = [];

    public function addObserver(Subscriber $subscriber)
    {
        $this->subscribers[] = $subscriber;
    }

    public function notifyObservers(Message $message)
    {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->onMessagePosted($message);
        }
    }

    public function sendMessage(Message $message)
    {
        $this->notifyObservers($message);
    }
}

/**
 * Class - klasa obserwatora
 */
class Subscriber implements Observer
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function onMessagePosted(Message $message)
    {
        echo $this->name . ' - otrzymałem wiadomość o treści: ' . $message->getContent() . '<br>';
    }
}

/**
 * kod Klienta
 */

$pawel = new Subscriber('Paweł');
$tomek = new Subscriber('Tomek');

$ns = new NotificationService();
$ns->addObserver($pawel);
$ns->addObserver($tomek);

$ns->sendMessage(new Message('Witaj w naszym newsletterze!'));
