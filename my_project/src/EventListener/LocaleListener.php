<?php
/**
 * Created by PhpStorm.
 * User: SauliusGTO3000
 * Date: 6/27/2018
 * Time: 14:23
 */

namespace App\EventListener;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class LocaleListener
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

    }

    public function setLocale(GetResponseEvent $event){
        $request = $event->getRequest();

        $request->setLocale($this->session->get('lang', 'en') );
//        var_dump($this->session->get('lang'));
    }

}