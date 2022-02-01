<?php

namespace App\Form;

use App\Entity\Upload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_pdf', FileType::class,[
                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'required' => true,
                'constraints' => [
                    new File([
                        'mimeTypes' => [ // We want to let upload only txt, csv or Excel files
                            'application/pdf',
                            //'image/png',
                            //'image/jpeg'

                        ],
                        'mimeTypesMessage' => "This document isn't valid.",
                    ])
                ],
            ])

            ->add('titre',null, array('label' => false))
            ->add('intitule_poste')
            ->add('description_poste')
            ->add('missions')
            ->add('statut', HiddenType::class)
            ->add('nombre_candidature', HiddenType::class)
            // ->add('logo_structure', FileType::class)
            ->add('experience', ChoiceType::class,  [
                'choices'  => [
                    'Pas d\'experience' => '0',
                    '1 an' => '1',
                    '2 ans' => '2',
                    '3 ans' => '3',
                    '4 ans' => '4',
                    '5 ans' => '5',
                    '6 ans' => '6',
                    '7 ans' => '7',
                    '8 ans' => '8',
                    '9 ans' => '9',
                    '10 ans' => '10',

                ],
            ])
            ->add('convention_collective')
            ->add('outils')
            ->add('temps_travail', ChoiceType::class, [
                'choices'  => [
                    '...' => '0',
                    '1 H' => '1',
                    '2 H' => '2',
                    '3 H' => '3',
                    '4 H' => '4',
                    '5 H' => '5',
                    '6 H' => '6',
                    '7 H' => '7',
                    '8 H' => '8',
                    '9 H' => '9',
                    '10 H' => '10',
                    '11 H' => '11',
                    '12 H' => '12',
                    '13 H' => '13',
                    '14 H' => '14',
                    '15 H' => '15',
                    '16 H' => '16',
                    '17 H' => '17',
                    '18 H' => '18',
                    '19 H' => '19',
                    '20 H' => '20',
                    '21 H' => '21',
                    '22 H' => '22',
                    '23 H' => '23',
                    '24 H' => '24',
                    '25 H' => '25',
                    '26 H' => '26',
                    '27 H' => '27',
                    '28 H' => '28',
                    '29 H' => '29',
                    '30 H' => '30',
                    '31 H' => '31',
                    '32 H' => '32',
                    '33 H' => '33',
                    '34 H' => '34',
                    '35 H' => '35',
                ],
            ])

            ->add('date_debut_contrat', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false

            ])

            ->add('date_entretien', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false

            ])
            ->add('date_publication', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false

            ])
            ->add('date_archivage', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false

            ])
            ->add('salaire')
            ->add('formation', ChoiceType::class, [
                'choices'  => [
                    '...' => 'nothing',
                    'BPJEPS' => 'BPJEPS',
                    'DEJEPS' => 'DEJEPS',
                    'Licence Management' => 'L_Management',
                    'Master Management' => 'M_Management',
                    'Licence APAS' => 'L_APAS',
                    'Master APAS' => 'M_APAS'
                ],
            ])
            ->add('competences')
            ->add('qualites')
            ->add('type_contrat', ChoiceType::class, [
                'choices'  => [
                    '...' => 'nothing',
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Stage' => 'Stage',
                    'CDI interimaire' => 'CDI_Interim',
                    'Service civique' => 'Service_civ',
                    'Saisonnier' => 'Saisonnier',

                ],
            ])
            ->add('categorie_contrat', ChoiceType::class, [
                'choices'  => [
                    '...' => 'nothing',
                    'Emploi' => 'Emploi',
                    'Service civique' => 'Service_civ',
                    'Alternance' => 'Alternance',
                    'Stage' => 'Stage',
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}
