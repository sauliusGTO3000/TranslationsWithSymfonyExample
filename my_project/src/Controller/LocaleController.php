<?php
/**
 * Created by PhpStorm.
 * User: SauliusGTO3000
 * Date: 6/27/2018
 * Time: 14:41
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends Controller
{
    /**
     * @Route("/locale/{lang}", name="locale_controller")
     */
    public function localeController($lang, SessionInterface $session){
        $session->set('lang', $lang);
        return $this->redirectToRoute("translations_index");
    }

}