<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ReclamationReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('reponse',TextareaType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message' => 'S il vous plaît entrer votre message',
                    ]),
                    new Length([
                                            'min' => 20,
                                            'minMessage' => 'Votre message est trop court.Il doit avoir au minimum {{ limit }} caractères',
                                            // max length allowed by Symfony for security reasons
                                            'max' => 4096,
                                        ]),

                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
