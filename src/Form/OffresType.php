<?php

namespace App\Form;

use App\Entity\Offres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OffresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('dateRelease', DateType::class,[
                'empty_data' => null,
                'attr'=>['class'=>'form-controller js-datepicker'],
                'widget'=>'single_text',
                'html5'=>FALSE
            ])
            ->add('description')
            ->add('details',TextareaType::class)

            ->add('pdf', FileType::class, array('label' => 'pdf (PDF file)','data_class'=>null))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offres::class,
        ]);
    }
}
