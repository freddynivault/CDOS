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
        return $this->render ('home/createaccount.html.twig');
    }

    /**
     * @Route("/listoffer", name="app_offers")
     */
    public function offer(): Response
    {
        return $this->render ('home/listoffer.html.twig');
    }

    /**
     * @Route("/createaccount", name="app_createaccount")
     */
    public function createaccount(): Response
    {
        return $this->render ('home/createaccount.html.twig');
    }

    /**
     * @Route("/connect", name="app_connect")
     */
    public function connect(): Response
    {
        return $this->render ('home/connect.html.twig');
    }


}
