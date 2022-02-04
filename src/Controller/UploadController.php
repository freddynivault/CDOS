<?php

namespace App\Controller;

use App\Entity\Upload;
use App\Form\UploadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UploadController extends AbstractController
{
    #[Route('/upload', name: 'app_upload')]
    public function maPage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $upload = new Upload();
        $form = $this->createForm(UploadType::class, $upload);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form-> isValid()){
            $file = $form->get('namePdf')->getData();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $upload->setNamepdf($fileName);



            $logo = $form->get('logoStructure')->getData();
            $logoName= md5(uniqid()).'.'.$logo->guessExtension();
            $logo->move($this->getParameter('upload_directory'),$logoName);
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


}