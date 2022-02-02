<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ])
            ->add('lastName', TextType::class, [
                'label' => false,
                'required' => false,
        ])
            ->add('nomStructure', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('descriptionStructure', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('logoStructure', IntegerType::class, [
                'label' => false,
                'required' => false,
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
