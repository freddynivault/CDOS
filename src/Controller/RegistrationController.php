<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\SuperAdminRegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            return $this->createUser($user, $userPasswordHasher, $form, $entityManager, $userAuthenticator, $authenticator, $request, false);
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/superAdminRegister', name: 'app_admin_register')]
    public function superAdminRegister(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(SuperAdminRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->createUser($user, $userPasswordHasher, $form, $entityManager, $userAuthenticator, $authenticator, $request, true);
        }

        return $this->render('registration/superAdminRegister.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @param User $user
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param FormInterface $form
     * @param EntityManagerInterface $entityManager
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param UserAuthenticator $authenticator
     * @param Request $request
     * @return Response|null
     */
    public function createUser(User $user, UserPasswordHasherInterface $userPasswordHasher, FormInterface $form, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, Request $request, bool $isSuperAdmin): ?Response
    {
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData(),
            )
        );
        $role = array($form->get('role')->getData());
        $user->setRoles($role);

        if($role[0] == "ROLE_ADMIN_STRUCTURE"){
            $user->setFirstName(null);
            $user->setLastName(null);
        }
        elseif ($role[0] == "ROLE_CANDIDAT"){
            $user->setNomStructure(null);
            $user->setDescriptionStructure(null);
        }
        elseif ($role[0] == "ROLE_SUPER_ADMIN"){
            $user->setNomStructure(null);
            $user->setDescriptionStructure(null);
            $user->setFirstName(null);
            $user->setLastName(null);
        }

        $entityManager->persist($user);
        $entityManager->flush();
        // do anything else you need here, like send an email

        if (!$isSuperAdmin)
        {
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
        return $this->redirectToRoute('app_alluser');
    }
}