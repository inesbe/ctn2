<?php

namespace App\Form;

use App\Entity\Medias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class MediasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('video', FileType::class, array('label' => 'Video (mp4 file)','data_class'=>null))
            ->add('image', FileType::class,array('data_class'=>null),[
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
                    ])
                ],
            ])
            ->add('description',TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medias::class,
        ]);
    }
}
