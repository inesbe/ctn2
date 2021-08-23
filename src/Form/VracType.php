<?php

namespace App\Form;

use App\Entity\Vrack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VracType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marchandises')
            ->add('nb_colis')
            ->add('poids_brute')
            ->add('codeEmballage')
            ->add('poids_unitaire')
            ->add('nom_destinataire')
            ->add('adresse')
            ->add('code_postale')
            ->add('pays')
            ->add('ville')
            ->add('etat_bl', CheckboxType::class, [
                'label'    => 'Garder votre BL',
                'required' => true,

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vrack::class,
        ]);
    }
}
