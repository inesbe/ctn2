<?php

namespace App\Form;

use App\Entity\Conteneur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('date_chargement',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('date_enlevement',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('poids_unitaire')
            ->add('nom_destinataire')
            ->add('adresse')
            ->add('code_postale')
            ->add('pays')
            ->add('ville')
            ->add('type', ChoiceType::class, [
                    'choices'  => [
                        'CITERNE' => 'CITERNE',
                        'CONTAINER DRY 20' => 'CONTAINER DRY 20',
                        'CONTAINER DRY 40' => 'CONTAINER DRY 40',
                        'FLEXITANK  20' => 'FLEXITANK  20',
                        'CONTAINER 10'=>'CONTAINER 10',
                        'CONTAINER 20'=>'CONTAINER 20',
                        'CONTAINER  (40)'=>'CONTAINER  (40)',
                        'ISOTANK 20'=>'ISOTANK 20',
                        'ISOTANK  (40)'=>'ISOTANK  (40)',
                        'CONTAINER DRY 20'=>'CONTAINER DRY 20',
                        'CONTAINER DRY 40'=>'CONTAINER DRY 40',
                        'MAFI 20'=>'MAFI 20',
                        'CONTAINER  (40)'=>'CONTAINER  (40)',
                        'CONTAINER OPEN TOP 20'=>'CONTAINER OPEN TOP 20',
                        'CONTAINER OPEN TOP 40'=>'CONTAINER OPEN TOP 40',



                    ]]
            )
            ->add('temperature')


            ->add('nb_colis')
            ->add('bl_etat', CheckboxType::class, [
                'label'    => 'Garder votre BL',
                'required' => true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conteneur::class,
        ]);
    }
}
