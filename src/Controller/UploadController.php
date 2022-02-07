<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UploadType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class UploadController extends AbstractController
{

    #[Route('/upload', name: 'app_upload')]
    public function maPage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $upload = new Offer();

        $form = $this->createForm(UploadType::class, $upload);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('namePdf')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $upload->setNamepdf($fileName);

            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
            $user = $this->getUser();
            $upload->setIdUser($user);


            $logo = $form->get('logoStructure')->getData();
            $logoName = md5(uniqid()) . '.' . $logo->guessExtension();
            $logo->move($this->getParameter('upload_directory'), $logoName);
            $upload->setLogoStructure($logoName);



            $upload->setStatut('Initial');

            $upload->setNombreCandidature('0');


            $entityManager->persist($upload);
            $entityManager->flush();
            return $this->redirectToRoute('app_offers');
        }


        return $this->render('offer/pouet.html.twig', [
            'formUpload' => $form->createView(),
        ]);

    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function DeleteOffer(ManagerRegistry $doctrine, int $id): Response
    {

        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);
        $offer->setStatut('Archive');
        $entityManager->persist($offer);
        $entityManager->flush();
        $offers = $entityManager->getRepository(Offer::class)->findAll();
        return $this->render('home/listoffer.html.twig', ['tableau' => $offers]);


    }

    #[Route('/modif/{id}', name: 'app_modif')]
    public function ModifOffer(Request $request, ManagerRegistry $doctrine, int $id): Response
    {

        $entityManager = $doctrine->getManager();
        $offer = $entityManager->getRepository(Offer::class)->find($id);

        $form = $this->createForm(UploadType::class, $offer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('namePdf')->getData();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('upload_directory'), $fileName);
            $offer->setNamepdf($fileName);

            $logo = $form->get('logoStructure')->getData();
            $logoName = md5(uniqid()) . '.' . $logo->guessExtension();
            $logo->move($this->getParameter('upload_directory'), $logoName);
            $offer->setLogoStructure($logoName);

            $entityManager->persist($offer);
            $entityManager->flush();
            return $this->redirectToRoute('app_offers');
        }
        return $this->render('home/modifoffer.html.twig', [
            'formModif' => $form->createView()

        ]);
    }


}