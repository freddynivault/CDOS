<?php

namespace App\Controller;

use App\Entity\Offer;
use App\Entity\Upload;
use App\Entity\User;
use App\Form\OfferType;
use App\Form\RegistrationFormType;
use App\Form\UploadType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\String\Slugger\SluggerInterface;


class UploadController extends AbstractController
{
    #[Route('/upload', name: 'app_upload')]
    public function maPage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()){
            $file = $form->get('name_pdf')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $upload->setNamepdf($fileName);
            $upload->setStatut('Initial');
            $upload->setNombreCandidature('0');

            $entityManager->persist($upload);
            $entityManager->flush();
            return $this->redirectToRoute('app_upload');
        }


        return $this->render('offer/pouet.html.twig', [
        'form' => $form->createView(),
    ]);

    }
}