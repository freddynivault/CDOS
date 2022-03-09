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

/**
 * Cette classe a pour but de gérer les offres. Leur ajout, leur création, et leur affichage
 */
class OfferController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     * Cette fonction a pour but d'ajouter une nouvelle offre.
     */
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
     * Cette fonction a pour but d'afficher touyte les offres pour le super admin
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
     * Cette fonction a pour but d'emmener à la page de création d'offre
     */
    public function createoffer(): Response
    {
        return $this->render('home/createoffer.html.twig');
    }

    /**
     * @Route("/listoffer", name="app_offers")
     * Cette fonction a pour but d'afficher les offres pour les candidats
     */
    public function offer(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render('home/listoffer.html.twig', ['offer' => $offer]);
    }

    /**
     * @Route("/viewoffer/{id}", name="app_viewoffer")
     * Cette fonction a pour but d'afficher une offre précise.
     */
    public function viewOffer(ManagerRegistry $doctrine, int $id): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        return $this->render('home/viewjoboffer.html.twig', ['offer' => $offer, 'user' => $user]);
    }
}