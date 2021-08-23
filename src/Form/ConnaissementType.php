<?php

namespace App\Form;

use App\Entity\Connaissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConnaissementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('conditions' , ChoiceType::class, [
                'choices'  => [
                    'Quai' => 'Quai',
                    'Yes' => 'Quai',
                    'No' => 'Quai',
                ]]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Connaissement::class,
        ]);
    }
}
