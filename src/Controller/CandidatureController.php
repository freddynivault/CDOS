<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\Offer;
use App\Form\CandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Cette classe a poyur but de gérer les candidature. L'affichage et l'ajout.
 */
class CandidatureController extends AbstractController
{
    /**
     * @param Request $request
     * @param EntityManagerInterface $entity
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     *
     * Cette fonction a pour but d'ajouter une candidature
     */
    #[Route('/postuler/{id}', name: 'app_candidature')]
    public function candidateOffer(Request $request, EntityManagerInterface $entity, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);

        $candidature= new Candidature();

        $form = $this->createForm(CandidatureType::class, $candidature);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Cette partie permet la récupération des deux fichiers
            $file = $form->get('cv')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $candidature->setCv($fileName);

            $file = $form->get('lettreMotivation')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $candidature->setLettreMotivation($fileName);
            // Cette partie permet de fixer le candidat qui pose l'offre et l'offre que laquelle la candidature est faite
            $user = $this->getUser();
            $candidature->setUser($user);
            $candidature->setOffer($offer);

            // Cela permet de mettre à jour les champs qui doivent l'etre, soit le nombre de candidature sur une offre
            $nbCandidature = $offer->getNombreCandidature();
            $nbCandidature = $nbCandidature +1;
            $offer->setNombreCandidature($nbCandidature);
            //Cette partie permet de s'assurer que le candidat ne pose pas de candidature sur une offre sur laquelle il a deja candidater
            $candidatureuser = $entityManager->getRepository(Candidature::class)->findall();

            $flag = false;
            dump($candidatureuser);
            if($candidatureuser != null) {
                dump($candidatureuser);
                for ($i = 0; $i <= count($candidatureuser)-1; $i++) {
                    $offre = $candidatureuser[$i]->getOffer();
                    $candidat = $candidatureuser[$i]->getUser();
                    if ($offre == $offer && $candidat == $user) {
                        $flag = true;
                    }

                }
            }
            dump($flag);
            if(!$flag) {
                $entityManager->persist($candidature);
                $entityManager->flush();
                return $this->redirectToRoute('app_offers');
            }
            else {
                $message = 'Vous avez deja postulé pour cette offre !';
                echo '<script type="text/javascript">window.confirm("' . $message . '");</script>';
            }


        }
       return $this->render ('home/viewjoboffer.html.twig', ['offer' => $offer, 'formCandidate' => $form->createView(), ]);

    }

    /**
     * Cette fonction a pour but de montrer une candidature précise
     * @Route("/displayapply/{id}", name="app_displayapply")
     */
    public function displayapply(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->find($id);

        return $this->render ('candidature/candidature.html.twig', ['candidature' => $candidature]);
    }

    /**
     * Cette fonction a pour but d'afficher toutes les candidature dans une datatable
     * @Route("/displayall", name="app_displayall")
     */
    public function displayall(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();
        $user = $this->getUser();

        return $this->render ('home/listallcandidature.html.twig', ['candidature' => $candidature, 'user'=>$user]);
    }

    /**
     * Cette fonction a pour but d'afficher les candidature d'un candidat précis
     * @Route("/myapply", name="app_mescandidatures")
     */
    public function myapply(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();
        $user = $this->getUser();

        return $this->render ('home/mescandidatures.html.twig', ['candidature' => $candidature, 'user'=>$user]);
    }

    /**
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return Response
     * Cette fonction a pour but de supprimer une candidature. Elle renvoit sur la liste des candidatures
     */
    #[Route('/deletecandidature/{id}', name: 'app_delete_candidature')]
    public function DeleteOffer(ManagerRegistry $doctrine, int $id): Response
    {
        $user = $this->getUser();
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->find($id);

        $entityManager->remove($candidature);
        $entityManager->flush();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();


        return $this->render('home/mescandidatures.html.twig', ['candidature' => $candidature, 'user'=> $user]);

    }

    /**
     * @Route("/listcandidature/{id}", name="app_apply")
     */
    public function apply(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $candidature = $entityManager->getRepository(Candidature::class)->findAll();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        return $this->render('home/listcandidature.html.twig', ['candidature' => $candidature, 'offer' => $offer]);
    }
}
