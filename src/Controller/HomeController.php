<?php

namespace App\Controller;

use App\Entity\Offer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
    public function offer(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render ('home/listoffer.html.twig', ['tableau' => $offer]);
    }

    /**
     * @Route("/viewoffer/{id}", name="app_viewoffer")
     */
    public function viewOffer(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        return $this->render ('home/viewjoboffer.html.twig', ['offer' => $offer]);
    }

    /**
     * @Route("/listcandidature", name="app_candidate")
     */
    public function candidate(): Response
    {
        return $this->render ('home/listcandidature.html.twig');
    }


    /**
     * @Route("/listofferAdmin", name="app_offersadmin")
     */
    public function offerAdmin(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render('home/listofferAdmin.html.twig', ['offer' => $offer, 'user'=> $user]);
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
     * @Route("/passforget", name="app_passforget")
     */
    public function passforget(): Response
    {
        return $this->render ('home/passforget.html.twig');
    }

    /**
     * @Route("/test", name="app_test")
     */
    public function test(): Response
    {
        return $this->render ('home/test.html.twig');
    }

}
