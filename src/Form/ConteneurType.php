<?php

namespace App\Form;

use App\Entity\Conteneur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConteneurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('ref')
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Standard 20' => 'Stadard20',
                    'Standard 40' => 'Standar40',
                    'High cube 20' => 'HighCube20',
                    'High cube 40' => 'HighCube40'
                ),))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conteneur::class,
        ]);
    }
}
