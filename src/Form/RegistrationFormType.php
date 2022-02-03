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

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'label' => false,
                'multiple' => true,
                'choices'  => [
                    'Candidat' => 'ROLE_CANDIDAT',
                    'Admin Structure' => 'ROLE_ADMIN_S',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
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
                'attr' => ['placeholder'=> 'Confirmez votre mot de passe']
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
