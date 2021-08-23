<?php

namespace App\Form;

use App\Entity\Chassis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChassisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',HiddenType::class)
            ->add('ref')
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'semi' => 'semi',
                ),))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chassis::class,
        ]);
    }
}
