<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(): Response
    {
        return $this->render ('home/index.html.twig');
    }

    /**
     * @Route("/listoffer", name="app_offers")
     */
    public function offer(): Response
    {
        return $this->render ('home/listoffer.html.twig');
    }

    /**
     * @Route("/listofferAdmin", name="app_offersadmin")
     */
    public function offerAdmin(): Response
    {
        return $this->render ('home/listofferAdmin.html.twig');
    }

    /**
     * @Route("/createaccount", name="app_createaccount")
     */
    public function createaccount(): Response
    {
        return $this->render ('home/createaccount.html.twig');
    }

    /**
     * @Route("/createoffer", name="app_createoffer")
     */
    public function createoffer(): Response
    {
        return $this->render ('home/createoffer.html.twig');
    }

    /**
     * @Route("/connect", name="app_connect")
     */
    public function connect(): Response
    {
        return $this->render ('home/connect.html.twig');
    }

    /**
     * @Route("/createaccountSAdmin", name="app_createaccountSAdmin")
     */
    public function createaccountSAdmin(): Response
    {
        return $this->render ('home/createaccountSAdmin.html.twig');
    }

    /**
     * @Route("/passforget", name="app_passforget")
     */
    public function passforget(): Response
    {
        return $this->render ('home/passforget.html.twig');
    }

}
