<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class SuperAdminRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role', ChoiceType::class, [
                'label' => false,
                'mapped' => false,
                'choices'  => [
                    'Candidat' => 'ROLE_CANDIDAT',
                    'Admin Structure' => 'ROLE_ADMIN_STRUCTURE',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ],
                'attr' => [
                    'id' => 'registration_form_role',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder'=> 'Adresse mail'],
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'attr' => ['placeholder'=> 'Mot de passe']
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false,
                'attr' => ['placeholder'=> 'Confirmez le mot de passe']
            ])
            ->add('firstName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder'=> 'Prénom']
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder'=> 'Nom']
        ])
            ->add('nomStructure', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder'=> 'Nom de la structure']
                ])
            ->add('descriptionStructure', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder'=> 'Description de la structure']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ],
        ]);
    }
}
