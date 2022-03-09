<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\Offer;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Cette classe contient les fonctions pour afficher les pages d'acceuil ainsi que les fonction du super admin
 */
class HomeController extends AbstractController
{
    /**
     * Cette fonction affiche la page d'acceuil, qui contient des compteur sur le nombre d'offre,
     * de condidature et de structure disponible sur le site
     * @Route("/", name="app_home")
     */
    public function home(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->findAll();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();
        $user = $entityManager->getRepository(User::class)->findAll();
        $nboffer = count($offer);
        $nbcandidature = count($candidature);
        $nbuser = 0;

        for ($i = 0; $i <= count($user) - 1; $i++) {
            $role = $user[$i]->getRoles();

            if ($role[0] == "ROLE_ADMIN_STRUCTURE") {
                $nbuser++;
            }
        }
        return $this->render('home/index.html.twig', ['offer' => $nboffer, 'candidature' => $nbcandidature, 'user' => $nbuser]);
    }



    /**
     * @Route("/connect", name="app_connect")
     * Cette fonction permet d'afficher la page de connection
     */
    public function connect(): Response
    {
        return $this->render('home/connect.html.twig');
    }

    /**
     * @Route("/passforget", name="app_passforget")
     * Cette fonction permet d'afficher la page de mot de passe oublié
     */
    public function passforget(): Response
    {
        return $this->render('home/passforget.html.twig');
    }

    /**
     * @Route("/allcandidature", name="app_allcandidature")
     * Cette fonction permet d'afficher toute les candidature du site
     */
    public function allcandidature(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();
        return $this->render('home/allcandidatures.html.twig', ['candidature' => $candidature]);
    }

    /**
     * @Route("/alluser", name="app_alluser")
     * Cette fonction permet d'afficher tous les users du site
     */
    public function alluser(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->findAll();
        return $this->render('home/alluser.html.twig', ['user' => $user]);
    }
}
