<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Form\OfferType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    #[Route('/addoffer', name: 'app_addoffer')]
    public function addoffer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offer = new Offer();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($offer);
            $entityManager->flush();
        }
        return $this->render('offer/addOffer.html.twig', [
        'form' => $form->createView(),
    ]);
    }


    /**
     * @Route("/listofferAdmin", name="app_offersadmin")
     */
    public function offerAdmin(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render('home/listofferAdmin.html.twig', ['offer' => $offer, 'user' => $user]);
    }

    /**
     * @Route("/createoffer", name="app_createoffer")
     */
    public function createoffer(): Response
    {
        return $this->render('home/createoffer.html.twig');
    }

    /**
     * @Route("/listoffer", name="app_offers")
     */
    public function offer(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render('home/listoffer.html.twig', ['offer' => $offer]);
    }

    /**
     * @Route("/viewoffer/{id}", name="app_viewoffer")
     */
    public function viewOffer(ManagerRegistry $doctrine, int $id): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        return $this->render('home/viewjoboffer.html.twig', ['offer' => $offer, 'user' => $user]);
    }
}