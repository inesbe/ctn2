<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('langue',ChoiceType::class,[
                'choices' => [
                    'Choisissez votre langue' => '',
                    'Arabe' => 'Arabe',
                    'Français' => 'Français',
                    'Anglais' => 'Anglais'

                ],
            ])
            ->add('email',EmailType::class)
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
                    ])
                ],
            ])
            ->add('password',PasswordType::class)
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('telephone',TextType::class)
            ->add('societe',TextType::class)
            ->add('typesociete',ChoiceType::class,[
                'choices' => [
                    'Choisissez le type de votre société'=>'',
                    '3e Partie Logistique' => '3e Partie Logistique',
                    'Consolidator/Trader' => 'Consolidator/Trader',
                    'Banque' => 'Banque',
                    'Agent d Etat' => 'Agent d Etat',
                    'Transitaire' => 'Transitaire',
                    'NVO (Non-vessel operating common carrier)' => 'NVO',
                    'BCO (Business Cargo owner)' => 'BCO',
                    'Douanes' => 'Douanes',
                    'Autre' => 'Autre'



                ],
            ])
            ->add('adresse',TextType::class)
            ->add('complementadresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('codepostal',TextType::class)
            ->add('pays',ChoiceType::class,[
                'choices' => [
                    'Choisissez votre pays / région' => '',
                    'AFGHANISTAN' => 'AFGHANISTAN',
                    'ALAND ISLANDS' => 'ALAND ISLANDS',
                    'ALBANIA' => 'ALBANIA',
                    'ALGERIA' => 'ALGERIA',
                    'AMERICAN SAMOA' => 'AMERICAN SAMOA',
                    'ANDORRA' => 'ANDORRA',
                    'ANGOLA' => 'ANGOLA',
                    'ANGUILLA' => 'ANGUILLA',
                    'ANTARCTICA' => 'ANTARCTICA',
                    'ANTIGUA AND BARBUDA' => 'ANTIGUA AND BARBUDA',
                    'ARGENTINA' => 'ARGENTINA',
                    'ARMENIA'=> 'ARMENIA',
                    'ARUBA' => 'ARUBA',
                    'AUSTRALIA' => 'AUSTRALIA',
                    'AUSTRIA' => 'AUSTRIA',
                    'AZERBAIJAN' => 'AZERBAIJAN',
                    'BAHAMAS' => 'BAHAMAS',
                    'BAHRAIN' => 'BAHRAIN',
                    'BANGLADESH' => 'BANGLADESH',
                    'BARBADOS' => 'BARBADOS',
                    'BELARUS' => 'BELARUS',
                    'BELGIUM' => 'BELGIUM',
                    'BELIZE' => 'BELIZE',
                    'BENIN' => 'BENIN',
                    'BERMUDA' => 'BERMUDA',
                    'BHUTAN' => 'BHUTAN',
                    'BOLIVIA' => 'BOLIVIA',
                    'BONAIRE, SINT EUSTATIUS & SABA' => 'BONAIRE, SINT EUSTATIUS & SABA',
                    'BOSNIA AND HERZEGOVINA' => 'BOSNIA AND HERZEGOVINA',
                    'BOTSWANA' => 'BOTSWANA',
                    'BOUVET ISLAND' => 'BOUVET ISLAND',
                    'BRAZIL' => 'BRAZIL',
                    'BRITISH INDIAN OCEAN TERRITORY' => 'BRITISH INDIAN OCEAN TERRITORY',
                    'BRITISH VIRGIN ISLANDS' => 'BRITISH VIRGIN ISLANDS',
                    'BRUNEI DARUSSALAM' => 'BRUNEI DARUSSALAM',
                    'BULGARIA' => 'BULGARIA',
                    'BURKINA FASO' => 'BURKINA FASO',
                    'BURUNDI' => 'BURUNDI',
                    'CAMBODIA' => 'CAMBODIA',
                    'CAMEROON' => 'CAMEROON',
                    'CANADA0' => 'CANADA',
                    'CAPE VERDE' => 'CAPE VERDE',
                    'CAYMAN ISLANDS' => 'CAYMAN ISLANDS',
                    'CENTRAL AFRICAN REPUBLIC' => 'CENTRAL AFRICAN REPUBLIC',
                    'CHAD' => 'CHAD',
                    'CHILE' => 'CHILE',
                    'CHINA' => 'CHINA',
                    'CHRISTMAS ISLAND' => 'CHRISTMAS ISLAND',
                    'COCOS (KEELING) ISLANDS' => 'COCOS (KEELING) ISLANDS',
                    'COLOMBIA' => 'COLOMBIA',
                    'COMOROS' => 'COMOROS',
                    'CONGO, DEMOCRATIC REPUBLIC OF' => 'CONGO, DEMOCRATIC REPUBLIC OF',
                    'CONGO, REPUBLIC OF THE' => 'CONGO, REPUBLIC OF THE',
                    'COOK ISLANDS' => 'COOK ISLANDS',
                    'COSTA RICA' => 'COSTA RICA',
                    'COTE D IVOIRE' => 'COTE D IVOIRE',
                    'CROATIA' => 'CROATIA',
                    'CUBA' => 'CUBA',
                    'CURACAO' => 'CURACAO',
                    'CYPRUS' => 'CYPRUS',
                    'CZECH REPUBLIC' => 'CZECH REPUBLIC',
                    'DENMARK' => 'DENMARK',
                    'DJIBOUTI' => 'DJIBOUTI',
                    'DOMINICA' => 'DOMINICA',
                    'DOMINICAN REPUBLIC' => 'DOMINICAN REPUBLIC',
                    'ECUADOR' => 'ECUADOR',
                    'EGYPT' => 'EGYPT',
                    'EL SALVADOR' => 'EL SALVADOR',
                    'EQUATORIAL GUINEA'=>'EQUATORIAL GUINEA',
                    'ERITREA' => 'ERITREA',
                    'ESTONIA' => 'ESTONIA',
                    'ETHIOPIA' => 'ETHIOPIA',
                    'FALKLAND ISL(MALVINAS)'=> 'FALKLAND ISL(MALVINAS)',
                    'FAROE ISLANDS' => 'FAROE ISLANDS',
                    'FIJI' => 'FIJI',
                    'FINLAND' => 'FINLAND',
                    'FRANCE' => 'FRANCE',
                    'FRENCH GUIANA' => 'FRENCH GUIANA' ,
                    'FRENCH POLYNESIA' => 'FRENCH POLYNESIA',
                    'FRENCH STHRN & ANTARCTIC LANDS'=> 'FRENCH STHRN & ANTARCTIC LANDS',
                    'GABON' => 'GABON',
                    'GAMBIA' => 'GAMBIA',
                    'GEORGIA'=> 'GEORGIA',
                    'GERMANY' => 'GERMANY',
                    'GHANA' => 'GHANA',
                    'GIBRALTAR' => 'GIBRALTAR',
                    'GREECE' => 'GREECE',
                    'GREENLAND' => 'GREENLAND',
                    'GRENADA' => 'GRENADA',
                    'GUADELOUPE' => 'GUADELOUPE',
                    'GUAM' => 'GUAM',
                    'GUATEMALA' => 'GUATEMALA',
                    'GUINEA' => 'GUINEA',
                    'GUINEA-BISSAU' => 'GUINEA-BISSAU',
                    'GUYANA' => 'GUYANA',
                    'HAITI'=> 'HAITI',
                    'HEARD ISLAND&MCDONALD ISLANDS' => 'HEARD ISLAND&MCDONALD ISLANDS',
                    'HOLY SEE' => 'HOLY SEE',
                    'HONDURAS' => 'HONDURAS',
                    'HONG KONG SAR, CHINA'=> 'HONG KONG SAR, CHINA',
                    'HUNGARY' => 'HUNGARY',
                    'ICELAND'=> 'ICELAND',
                    'INDIA' => 'INDIA',
                    'INDONESIA' => 'INDONESIA',
                    'IRAQ' => 'IRAQ',
                    'IRELAND' => 'IRELAND',
                    'ISRAEL' => 'ISRAEL',
                    'ITALY' => 'ITALY',
                    'JAMAICA' => 'JAMAICA',
                    'JAPAN' => 'JAPAN',
                    'JORDAN' => 'JORDAN',
                    'KAZAKHSTAN' => 'KAZAKHSTAN',
                    'KENYA' => 'KENYA',
                    'KIRIBATI' => 'KIRIBATI',
                    'KUWAIT' => 'KUWAIT',
                    'KYRGYZSTAN' => 'KYRGYZSTAN',
                    'LAO PEOPLE S DEMOCRATIC REPUBLIC' => 'LAO PEOPLE S DEMOCRATIC REPUBLIC',
                    'LATVIA' => 'LATVIA',
                    'LEBANON' => 'LEBANON',
                    'LESOTHO' => 'LESOTHO',
                    'LIBERIA' => 'LIBERIA',
                    'LIBYA' => 'LIBYA',
                    'LIECHTENSTEIN' => 'LIECHTENSTEIN',
                    'LITHUANIA' => 'LITHUANIA',
                    'LUXEMBOURG' => 'LUXEMBOURG',
                    'MACAU' => 'MACAU',
                    'MACEDONIA, FORMER YUGOSLAV REP. OF' => 'MACEDONIA, FORMER YUGOSLAV REP. OF',
                    'MADAGASCAR' => 'MADAGASCAR',
                    'MALAWI' => 'MALAWI',
                    'MALAYSIA' => 'MALAYSIA',
                    'MALDIVES' => 'MALDIVES',
                    'MALI' => 'MALI',
                    'MALTA' => 'MALTA',
                    'MARSHALL ISLANDS' => 'MARSHALL ISLANDS',
                    'MAURITANIA' => 'MAURITANIA',
                    'MAURITIUS' => 'MAURITIUS',
                    'MAYOTTE' => 'MAYOTTE',
                    'MEXICO' => 'MEXICO',
                    'MICRONESIA, FEDERATED ST OF' => 'MICRONESIA, FEDERATED ST OF',
                    'MOLDOVA, REPUBLIC OF' => 'MOLDOVA, REPUBLIC OF',
                    'MONACO' => 'MONACO',
                    'MONGOLIA' => 'MONGOLIA',
                    'MONTENEGRO' => 'MONTENEGRO',
                    'MONTSERRAT' => 'MONTSERRAT',
                    'MOROCCO' => 'MOROCCO',
                    'MOZAMBIQUE' => 'MOZAMBIQUE',
                    'MYANMAR' => 'MYANMAR',
                    'NAMIBIA' => 'NAMIBIA',
                    'NAURU' => 'NAURU',
                    'NEPAL' => 'NEPAL',
                    'NETHERLANDS' => 'NETHERLANDS',
                    'NETHERLANDS ANTILLES' => 'NETHERLANDS ANTILLES',
                    'NEW CALEDONIA' => 'NEW CALEDONIA',
                    'NEW ZEALAND' => 'NEW ZEALAND',
                    'NICARAGUA' => 'NICARAGUA',
                    'NIGER' => 'NIGER',
                    'NIGERIA' => 'NIGERIA',
                    'NIUE' => 'NIUE',
                    'NORFOLK ISLAND' => 'NORFOLK ISLAND',
                    'NORTH KOREA' => 'NORTH KOREA',
                    'NORTHERN MARIANA ISLANDS' => 'NORTHERN MARIANA ISLANDS',
                    'NORWAY' => 'NORWAY',
                    'OMAN' => 'OMAN',
                    'PAKISTAN' => 'PAKISTAN',
                    'PALAU' => 'PALAU',
                    'PALESTINE, STATE OF' => 'PALESTINE, STATE OF',
                    'PANAMA' => 'PANAMA',
                    'PAPUA NEW GUINEA' => 'PAPUA NEW GUINEA',
                    'PARAGUAY' => 'PARAGUAY',
                    'PERU' => 'PERU',
                    'PHILIPPINES' => 'PHILIPPINES',
                    'PITCAIRN' => 'PITCAIRN',
                    'POLAND' => 'POLAND',
                    'PORTUGAL' => 'PORTUGAL',
                    'PUERTO RICO' => 'PUERTO RICO',
                    'QATAR' => 'QATAR',
                    'REUNION' => 'REUNION',
                    'ROMANIA' => 'ROMANIA',
                    'RUSSIAN FEDERATION' => 'RUSSIAN FEDERATION',
                    'RWANDA' => 'RWANDA',
                    'SAINT BARTHELEMY' => 'SAINT BARTHELEMY',
                    'SAINT HELENA' => 'SAINT HELENA',
                    'SAINT KITTS AND NEVIS' => 'SAINT KITTS AND NEVIS',
                    'SAINT LUCIA' => 'SAINT LUCIA',
                    'SAINT MARTIN' => 'SAINT MARTIN',
                    'SAINT PIERRE AND MIQUELON' => 'SAINT PIERRE AND MIQUELON',
                    'SAMOA' => 'SAMOA',
                    'SAN MARINO' => 'SAN MARINO',
                    'SAO TOME AND PRINCIPE' => 'SAO TOME AND PRINCIPE',
                    'SAUDI ARABIA' => 'SAUDI ARABIA',
                    'SENEGAL' => 'SENEGAL',
                    'SERBIA' => 'SERBIA',
                    'SEYCHELLES' => 'SEYCHELLES',
                    'SIERRA LEONE' => 'SIERRA LEONE',
                    'SINGAPORE' => 'SINGAPORE',
                    'SINT MAARTEN' => 'SINT MAARTEN',
                    'SLOVAKIA' => 'SLOVAKIA',
                    'SLOVENIA' => 'SLOVENIA',
                    'SOLOMON ISLANDS' => 'SOLOMON ISLANDS',
                    'SOMALIA' => 'SOMALIA',
                    'SOUTH AFRICA' => 'SOUTH AFRICA',
                    'SOUTH KOREA' => 'SOUTH KOREA',
                    'SOUTH SUDAN' => 'SOUTH SUDAN',
                    'SPAIN' => 'SPAIN',
                    'SRI LANKA' => 'SRI LANKA',
                    'ST VINCENT AND THE GRENADINES' => 'ST VINCENT AND THE GRENADINES',
                    'STH GEORGIA AND STH SANDWICH I' => 'STH GEORGIA AND STH SANDWICH I',
                    'SUDAN' => 'SUDAN',
                    'SURINAME' => 'SURINAME',
                    'SVALBARD AND JAN MAYEN ISL' => 'SVALBARD AND JAN MAYEN ISL',
                    'SWAZILAND' => 'SWAZILAND',
                    'SWEDEN' => 'SWEDEN',
                    'SWITZERLAND' => 'SWITZERLAND',
                    'SYRIAN ARAB REPUBLIC' => 'SYRIAN ARAB REPUBLIC',
                    'TAIWAN, CHINA' => 'TAIWAN, CHINA',
                    'TAJIKISTAN' => 'TAJIKISTAN',
                    'TANZANIA' => 'TANZANIA',
                    'THAILAND' => 'THAILAND',
                    'TIMOR-LESTE' => 'TIMOR-LESTE',
                    'TOGO' => 'TOGO',
                    'TOKELAU' => 'TOKELAU',
                    'TONGA' => 'TONGA',
                    'TRINIDAD AND TOBAGO' => 'TRINIDAD AND TOBAGO',
                    'TUNISIA' => 'TUNISIA',
                    'TURKEY' => 'TURKEY',
                    'TURKMENISTAN' => 'TURKMENISTAN',
                    'TURKS AND CAICOS ISLANDS' => 'TURKS AND CAICOS ISLANDS',
                    'TUVALU' => 'TUVALU',
                    'UGANDA' => 'UGANDA',
                    'UKRAINE' => 'UKRAINE',
                    'UNITED ARAB EMIRATES' => 'UNITED ARAB EMIRATES',
                    'UNITED KINGDOM' => 'UNITED KINGDOM',
                    'UNITED STATES' => 'UNITED STATES',
                    'URUGUAY' => 'URUGUAY',
                    'US MINOR ISLANDS' => 'US MINOR ISLANDS',
                    'UZBEKISTAN' => 'UZBEKISTAN',
                    'VANUATU' => 'VANUATU',
                    'VENEZUELA' => 'VENEZUELA',
                    'VIET NAM' => 'VIET NAM',
                    'VIRGIN ISLANDS, U.S.' => 'VIRGIN ISLANDS, U.S.',
                    'WALLIS AND FUTUNA' => 'WALLIS AND FUTUNA',
                    'WESTERN SAHARA' => 'WESTERN SAHARA',
                    'YEMEN' => 'YEMEN',
                    'ZAMBIA' => 'ZAMBIA',
                    'ZIMBABWE' => 'ZIMBABWE'



                ],
            ])
            ->add('tva',TextType::class)
            ->add('collegue',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
