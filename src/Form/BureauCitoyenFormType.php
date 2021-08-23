<?php

namespace App\Form;

use App\Entity\Bureaucitoyen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BureauCitoyenFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $countries = Intl::getRegionBundle()->getCountryNames();

        $builder-
        $builder
            ->add('nom')
            ->add('prenom')
        ->add('nationalite', ChoiceType::class, array(
            'choices' => array_flip($countries),
            'label'=>'Natinalité'
        ))
            ->add('email')
            ->add('adresse')
            ->add('codepostale')
            ->add('ville')
            ->add('telephone')
            ->add('message')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bureaucitoyen::class,
        ]);
    }
}
