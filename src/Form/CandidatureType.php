<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('cv', FileType::class, [

                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [ // We want to let upload only txt, csv or Excel files
                            'application/pdf',
                            "application/x-pdf",


                        ],
                        'mimeTypesMessage' => "Ce document n'est pas un PDF",
                    ])
                ],
            ])
            ->add('lettreMotivation', FileType::class, [

                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [ // We want to let upload only txt, csv or Excel files
                            'application/pdf',
                            "application/x-pdf",


                        ],
                        'mimeTypesMessage' => "Ce document n'est pas un PDF",
                    ])
                ],
            ])

            ->add('commentaire', TextareaType::class,array('label' => false))
            ->add('submit', SubmitType::class);
    }
}