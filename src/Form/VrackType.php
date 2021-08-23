<?php

namespace App\Form;

use App\Entity\Vrack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('ref')
            ->add('codeEmballage', ChoiceType::class, array(
                'choices'  => array(
                    'Coffre(s)' => 'CR',
                    'Bocaux' => 'BC',
                    'Bouteilles vide de gaz comprimes' => 'BV',
                    'Cageauts' => 'CG',
                    'Caisses' => 'CC',
                    'Chariot elevateur' => 'CH',
                    'Colis' => 'AE',
                    'Cylindre' => 'CY',
                    'Estagnons' => 'CE',
                    'Fardeau' => 'FA',
                    'Filet' => 'FL',
                    'Futs' => 'CF',
                    'Lot' => 'LT',
                    'Packages' => 'CA',
                    'Palettes' => 'PA',
                    'Palettes primeurs' => 'PP',
                    'Paquets' => 'PQ',
                    'Planchette' => 'PH',
                    'Ponton' => 'PO',
                    'Presses ramasseuses' => 'PS',
                    'Rouleaux' => 'RL',
                    'Sacherie' => 'SP',
                    'Sacs' => 'CS',
                    'Sceaux' => 'SC',
                    'Tambours en bois' => 'TB',
                    'Tambours métaliques' => 'TM',
                    'Tonneaux' => 'TN',
                    'Tonnelets' => 'TL',
                    'Touret' => 'CT',
                    'Tubes' => 'TE',
                ),))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vrack::class,
        ]);
    }
}
