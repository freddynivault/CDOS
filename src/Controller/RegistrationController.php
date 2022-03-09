<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\SuperAdminSuperAdminRegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

/**
 * Ce controller a pour but de gérer l'inscription et la connection au site. Il a été générer automatiquement par le bundle Registyration de sympony
 * Les modification sont expliqué dans le code
 */
class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param UserAuthenticator $authenticator
     * @param EntityManagerInterface $entityManager
     * @return Response
     * Cette fonction a pour but de créer un nouvelle utilisateur. C'est une fonction de base que nous n'avons pas modifier
     */
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

    /**
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param UserAuthenticator $authenticator
     * @param EntityManagerInterface $entityManager
     * @return Response
     * Cette fonction permet de créer un nouvelle utilisateur pour le super admin
     */
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
     *
     * Cette fonction est celle qui créer l'utilisateur. Elle permet d'hacher le mot de passe, ainsi que de donenr un role a l'utilisateur.
     * Elle permet aussi de fixer a null les champs qui doivent l'etre selon le type d'utilisateur, car nous ne pouvons pas empecher l'utilisateur de les remplir
     */
    public function createUser(User $user, UserPasswordHasherInterface $userPasswordHasher, FormInterface $form, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, Request $request, bool $isSuperAdmin): ?Response
    {
        //cette partie permet de rendre le mot de passe hacher.
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData(),
            )
        );

        $role = array($form->get('role')->getData());
        $user->setRoles($role);

        //Cette partie permet de mettre les champs qui doivent etre null à null dépendant du type d'utilisateur.
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