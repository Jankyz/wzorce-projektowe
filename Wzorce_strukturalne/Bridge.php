<?php
/**
 * Created by PhpStorm.
 * User: Rados
 * Date: 14.10.2018
 * Time: 18:55
 */

/**
 * wzorzec strukturalny --- Most - Bridge
 * - oddziela abstrakcje obiektu od jego implementacji
 * - dzięki temu mozna je latwo niezaleznie zmieniac
 * - dwie oddiezlne hierarchie
 * - komponenty aplikacji do abstrakcja
 * - platforma to implementacja, a most pozwala te hierarchie powiązać
 * Przykład:
 * - komponenty na rozne platformy mobilne IOS, Andriod
 * - kazdy komponent musi byc dostepny dla kazdej platformy, w praktyce duza ilosc klas i trudnosc pracy
 * - Bridge rozwiazuje ten problem
 * Schemat
 * AppComponent -----> Platform
 *   ->Card              IOS
 *  ->Player            Android
 */

interface AppComponent
{
    public function __construct(Platform $platform);
    public function getName();
}

/**
 * Class VideoPlayer
 */
class VideoPlayer implements AppComponent
{
    protected $platform;

    public function __construct(Platform $platform)
    {
        $this->platform = $platform;
    }

    public function getName()
    {
        return 'Komponent VideoPlayer' . ' - ' . $this->platform->getPlatform();
    }
}

/**
 * Class Card
 */
class Card implements AppComponent
{
    protected $platform;

    public function __construct(Platform $platform)
    {
        $this->platform = $platform;
    }

    public function getName()
    {
        return 'Komponent Card' . ' - ' . $this->platform->getPlatform();
    }
}

/**
 * Interface Platform
 */
interface Platform
{
    public function getPlatform();
}

/**
 * Class IOS
 */
class IOS implements Platform
{
    public function getPlatform()
    {
        return 'IOS';
    }

}

/**
 * Class Android
 */
class Android implements Platform
{
    public function getPlatform()
    {
        return 'Android';
    }

}

$android = new Android();
$videoPlayer = new VideoPlayer($android);

echo $videoPlayer->getName();
echo '<br>';

$ios = new IOS();
$card = new Card($ios);

echo $card->getName();