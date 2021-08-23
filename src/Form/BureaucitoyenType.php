<?php

namespace App\Form;

use App\Entity\Bureaucitoyen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;


class BureaucitoyenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')


            ->add('nationalite', CountryType::class, array( 'label' => 'Nationalité',


            ))
            ->add('email')
            ->add('adresse')
            ->add('codepostale')
            ->add('ville')
            ->add('telephone')
            ->add('etat', CheckboxType::class, [
                'label'    => 'Etat',
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'attr' => ['class' => 'tinymce'],
            ]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bureaucitoyen::class,
        ]);
    }
}
