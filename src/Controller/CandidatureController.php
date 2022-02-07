<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\Upload;
use App\Form\CandidatureType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidatureController extends AbstractController
{
    #[Route('/postuler/{id}', name: 'app_candidature')]
    public function candidateOffer(Request $request, EntityManagerInterface $entity, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Upload::class)->find($id);


        $candidature= new Candidature();

        $form = $this->createForm(CandidatureType::class, $candidature);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('cv')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $candidature->setCv($fileName);

            $file = $form->get('lettreMotivation')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $candidature->setLettreMotivation($fileName);


            $user = $this->getUser();
            $candidature->setUser($user);
            $candidature->setOffer($offer);

            $nbCandidature = $offer->getNombreCandidature();
            $nbCandidature = $nbCandidature +1;
            $offer->setNombreCandidature($nbCandidature);



            $entityManager->persist($candidature);
            $entityManager->flush();

            return $this->redirectToRoute('app_offers');
        }
       return $this->render ('home/viewjoboffer.html.twig', ['offer' => $offer, 'formCandidate' => $form->createView(), ]);

    }
}
