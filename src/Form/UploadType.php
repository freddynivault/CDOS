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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('nomStructure',TextType::class, [
                'label' => false,

            ])
            ->add('localisation',TextType::class, [
                'label' => false,

            ])
            ->add('descriptionStructure', TextareaType::class,array('label' => false))

            ->add('namePdf', FileType::class,[

                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'attr' => [
                    'id' => 'draganddropcreate',
                ],
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

            ->add('titre',null, array('label' => false))
            ->add('intitulePoste',null, array('label' => false))
            ->add('descriptionPoste',null, array('label' => false))
            ->add('missions',null, array('label' => false))
            ->add('statut', HiddenType::class)
            ->add('nombreCandidature', HiddenType::class)
            ->add('logoStructure', FileType::class,[

                'label' => false,
                'mapped' => false, // Tell that there is no Entity to link
                'constraints' => [
                    new File([
                        'mimeTypes' => [ // We want to let upload only txt, csv or Excel files

                            'image/png',
                            'image/jpeg'

                        ],
                        'mimeTypesMessage' => "Ce document n'est pas une image (.jpeg ou .png)",
                    ])
                ],
            ])
            ->add('experience', ChoiceType::class,  [
                'choices'  => [
                    'Pas d\'experience' => 'Aucune experience',
                    '1 an' => '1 an',
                    '2 ans' => '2 ans',
                    '3 ans' => '3 ans',
                    '4 ans' => '4 ans',
                    '5 ans' => '5 ans',
                    '6 ans' => '6 ans',
                    '7 ans' => '7 ans',
                    '8 ans' => '8 ans',
                    '9 ans' => '9 ans',
                    '10 ans' => '10 ans',

                ],
                'label' => false
            ])
            ->add('conventionCollective',null, array('label' => false))
            ->add('outils',null, array('label' => false))
            ->add('tempsTravail', ChoiceType::class, [
                'choices'  => [
                    '...' => '0',
                    '1 H' => '1 H',
                    '2 H' => '2 H',
                    '3 H' => '3 H',
                    '4 H' => '4 H',
                    '5 H' => '5 H',
                    '6 H' => '6 H',
                    '7 H' => '7 H',
                    '8 H' => '8 H',
                    '9 H' => '9 H',
                    '10 H' => '10 H',
                    '11 H' => '11 H',
                    '12 H' => '12 H',
                    '13 H' => '13 H',
                    '14 H' => '14 H',
                    '15 H' => '15 H',
                    '16 H' => '16 H',
                    '17 H' => '17 H',
                    '18 H' => '18 H',
                    '19 H' => '19 H',
                    '20 H' => '20 H',
                    '21 H' => '21 H',
                    '22 H' => '22 H',
                    '23 H' => '23 H',
                    '24 H' => '24 H',
                    '25 H' => '25 H',
                    '26 H' => '26 H',
                    '27 H' => '27 H',
                    '28 H' => '28 H',
                    '29 H' => '29 H',
                    '30 H' => '30 H',
                    '31 H' => '31 H',
                    '32 H' => '32 H',
                    '33 H' => '33 H',
                    '34 H' => '34 H',
                    '35 H' => '35 H',
                ],
                'label' => false
            ])

            ->add('dateDebutContrat', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'label' => false

            ])

            ->add('dateEntretien', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'label' => false

            ])
            ->add('datePublication', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'label' => false

            ])
            ->add('dateArchivage', DateType::class, [

                'widget' => 'single_text',
                // this is actually the default format for single_text
                'required' => false,
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'label' => false

            ])
            ->add('salaire',null, array('label' => false))
            ->add('formation', ChoiceType::class,   [
                'choices'  => [
                    '...' => 'nothing',
                    'BPJEPS' => 'BPJEPS',
                    'DEJEPS' => 'DEJEPS',
                    'Licence Management' => 'Licence Management',
                    'Master Management' => 'Master Management',
                    'Licence APAS' => 'Licence APAS',
                    'Master APAS' => 'Licence APAS'
                ],
                'label' => false
            ])
            ->add('competences',null, array('label' => false))
            ->add('qualites',null, array('label' => false))
            ->add('typeContrat', ChoiceType::class, [
                'choices'  => [
                    '...' => 'nothing',
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Stage' => 'Stage',
                    'CDI interimaire' => 'CDI interimaire',
                    'Service civique' => 'Service civique',
                    'Saisonnier' => 'Saisonnier',

                ],
                'label' => false
            ])
            ->add('categorieContrat', ChoiceType::class, [
                'choices'  => [
                    '...' => 'nothing',
                    'Emploi' => 'Emploi',
                    'Service civique' => 'Service civique',
                    'Alternance' => 'Alternance',
                    'Stage' => 'Stage',
                ],
                'label' => false
            ])
            ->add('submit', SubmitType::class )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Upload::class,
        ]);
    }
}
