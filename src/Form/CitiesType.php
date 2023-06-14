<?php

namespace App\Form;

use App\Entity\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;


class CitiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control mt-2 fs-4'
                ],
                'label_attr' => [
                    'class' => 'form-label fs-3'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/[a-z][A-Z]/',
                        'message' => 'Veuillez entrer un nom de ville valide'
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cities::class,
        ]);
    }
}
