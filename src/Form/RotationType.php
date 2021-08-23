<?php

namespace App\Form;

use App\Entity\Rotation;
use App\Repository\LigneRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RotationType extends AbstractType
{
    private $ligneRepository;
    public  function __construct(LigneRepository $ligneRepository)
    {
        $this->ligneRepository=$ligneRepository;

    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_navire')
            ->add('Port_depart')
            ->add('date_depart')
            ->add('Port_arrive')
            ->add('Date_arrive')
            ->add('type')
            ->add('status')
            ->add('id_ligne',ChoiceType::class,[

                'multiple' => false,
                'choices' =>

                    $this->ligneRepository->createQueryBuilder('u')->select('u.id')->getQuery()->getResult(),
                'choice_label' => function ($choice) {
                    return $choice;
                },]);



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rotation::class,
        ]);
    }
}
