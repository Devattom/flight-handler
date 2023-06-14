<?php

namespace App\Form;

use App\Entity\Flights;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\PositiveOrZero;

class FlightsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('flight_nb',TextType::class,[
                'label' => 'Numéro de vol :',
                'data' => $this->randNbFlight(),
                'required' => true,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' =>'/^[A-Z]{2}[0-9]{4}/',
                        'message' => 'Veuillez entrer un numéro de vol valide'
                    ])
                ]
            ])
            ->add('departure_datetime', DateTimeType::class, [
                'input' => 'datetime_immutable',
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'date_widget' => 'single_text',
                'label' => 'Date et heure de départ : ',
                'required' => true,
                'attr' => [
                    'class' => 'd-flex'
                ],
                'label_attr' => [
                    'class' => 'fs-3 mt-3'
                ]
            ])
            ->add('arrival_datetime', DateTimeType::class, [
                'input' => 'datetime_immutable',
                'placeholder' => [
                    'hour' => 'Heure', 'minute' => 'Minute',
                ],
                'date_widget' => 'single_text',
                'label' => 'Date et heure d\'arrivée',
                'required' => true,
                'attr' => [
                    'class' => 'd-flex'
                ],
                'label_attr' => [
                    'class' => 'mt-3 fs-3'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'required' => true,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3 mt-3'
                ],
                'constraints' => [
                    new PositiveOrZero([
                        'message' => 'Le prix doit être positif'
                    ])
                ]
                
            ])
            ->add('discount', CheckboxType::class, [
                'label' => 'Remise activée',
                'required' => false,
                'attr' => [
                    'class' => 'mt-3'
                ],
                'label_attr' => [
                    'class' => 'fs-3 me-3'
                ]
            ])
            ->add('available_seat', IntegerType::class, [
                'label' => 'Sièges disponible',
                'required' => true,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3 mt-3'
                ],
                'constraints' => [
                    new Length ([
                        'min' => 1,
                        'max' => 3,
                        'maxMessage' => 'Veuillez rentrer un nombre valide'
                    ]),
                    new PositiveOrZero([
                        'message' => 'Le nombre de siège doit être positif'
                    ])
                ]
            ])
            ->add('departure_city',null, [
                'label' => 'Ville de départ',
                'required' => true,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3 mt-3'
                ]
            ])
            ->add('arrival_city', null, [
                'label' => 'Ville d\'arrivée',
                'required' => true,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3 mt-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flights::class,
        ]);
    }

    public function randNbFlight()
    {
        $lettres = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $chiffres = [1,2,3,4,5,6,7,8,9];
        $randFlight = [];
        for($i = 0; $i < 2; $i++){
            $randFlight[]= $lettres[rand(0,25)];
        }
        for($i = 0; $i < 4; $i++){
            $randFlight[]= strval($chiffres[rand(0,8)]) ;
        }
        $stringRandFlight = implode("", $randFlight);
        return $stringRandFlight;
        
    }
}
