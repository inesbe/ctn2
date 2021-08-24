<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('role_admin',ChoiceType::class,[
                'choices' => [
                    'Choisissez le role' => null,
                    'Super admin' => 1,
                    'Admin Passage' => 2,
                    'Admin Fret' => 3,
                    'Admin news'=> 4,
                    'Admin Appel d"offre' => 5
                ],
                'constraints'=> [
                    new NotBlank([
                        'message' => "S'il vous plaît entrer le role",
                    ]),
                ],
            ])

            ->add('image',FileType::class,[
                'label' => 'Image(jpg,png,jpeg)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => true,

                'required'=>false,
                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Image invalide : (jpg,png,jpeg)',
                    ]),

                ],

            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
