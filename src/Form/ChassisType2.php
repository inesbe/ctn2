<?php

namespace App\Form;

use App\Entity\Chassis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChassisType2 extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('metre_linaire')
            ->add('largeur')
            ->add('hauteur')
            ->add('tare')

            ->add('date_changement',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('date_enlevment',DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('nature' , ChoiceType::class, [
                    'choices'  => [
                        'Dangereux' => 'Dangereux',
                        'Frigo' => 'Frigo',
                        'Charge' => 'Charge',
                    ]]
            )

            ->add('temeprature')


            ->add('nb_colis')
            ->add('type', ChoiceType::class, [
                    'choices'  => [
                        'AMBULANCE' => 'AMBULANCE',
                        'AUTOCAR' => 'AUTOCAR',
                        'BALAYEUSE' => 'BALAYEUSE',
                        'BATEAU PLAISANCE' => 'BATEAU PLAISANCE',
                        'BENNE BASCULANTE' => 'BENNE BASCULANTE',
                        'BERLIET' => 'BERLIET',
                        'BETONNIERE' => 'BETONNIERE',
                        'BUS' => 'BUS',
                        'CAMION/REM' => 'CAMION/REM',
                        'CHARIOT ELEVATEUR' => 'CHARIOT ELEVATEUR',
                        'ENSEMBLE ROUTIER' => 'ENSEMBLE ROUTIER',
                        'OMNIBUS' => 'OMNIBUS',
                        'SEMI REMORQUE' => 'SEMI REMORQUE',
                        'TRACTEUR' => 'TRACTEUR',
                        'TRANSCONTAINER SUR REMORQUE' => 'TRANSCONTAINER SUR REMORQUE',
                        'VOITURE' => 'VOITURE',


                    ]]
            )
            ->add('poids_unitaire')
            ->add('marchandises')
            ->add('emballage', ChoiceType::class, [
                    'choices'  => [
                        'COFFRE(S)' => 'COFFRE(S)',
                        'bocaux' => 'bocaux',
                        'Bouteilles vide de gaz comprimes' => 'Bouteilles vide de gaz comprimes',
                        'Cageauts' => 'Cageauts',
                        'Caisses' => 'Caisses',
                        'Chariot elevateur' => 'Chariot elevateur',
                        'Colis' => 'Colis',
                        'Cylindre' => 'Cylindre',
                        'Estagnons' => 'Estagnons',
                        'Fardeau' => 'Fardeau',
                        'Filet' => 'Filet',
                        'Futs' => 'Futs',
                        'LOT' => 'LOT',
                        'PACKAGES' => 'PACKAGES',
                        'Palettes' => 'Palettes',
                        'palettes primeurs' => 'palettes primeurs',
                        'paquets'=>'',
                        'planchette'=>'paquets',
                        'ponton'=>'ponton',
                        'presses ramasseuses'=>'presses ramasseuses',
                        'rouleaux'=>'rouleaux',
                        'Sacherie'=>'Sacherie',
                        'Sacs'=>'Sacs',
                        'sceaux'=>'sceaux',
                        'Tambours en bois'=>'Tambours en bois',
                        'Tambours métaliques'=>'Tambours métaliques',
                        'Tonneaux'=>'Tonneaux',
                        'Tonnelets'=>'Tonnelets',
                        'Touret'=>'Touret',
                        'TUBES'=>'TUBES',






                    ]]
            )
            ->add('nom_destinataire')
            ->add('adresse')
            ->add('code_postale')
            ->add('pays')
            ->add('ville')
            ->add('remarque')

            ->add('etat_bl', CheckboxType::class, [
                'label'    => 'Garder votre BL',
                'required' => true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chassis::class,
        ]);
    }
}
