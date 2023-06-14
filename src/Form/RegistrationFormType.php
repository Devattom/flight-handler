<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre Email :',
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3'
                ],
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez rentrer un mail valide'
                    ])
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'class' => 'fs-4'
                ],
                'label_attr' => [
                    'class' => 'fs-3'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit être d\'au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre Nom :',
                'attr' => [
                    'class' => 'fs-4'
                ], 
                'label_attr' => [
                    'class' => 'fs-3'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/[a-zA-Z]/',
                        'message' => 'Veuillez entrer un nom valide'
                    ]),
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre Prénom :',
                'attr' => [
                    'class' => 'fs-4'
                ], 
                'label_attr' => [
                    'class' => 'fs-3'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/[a-zA-Z]/',
                        'message' => 'Veuillez entrer un nom prénom valide'
                    ]),
                ]
            ])
            ->add('CGU', CheckboxType::class, [
                'mapped' => false,
                'label' => 'CGU',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGU.',
                    ]),
                ],
                'attr' => [
                    'class' => 'mt-3'
                ],
                'label_attr' => [
                    'class' => 'fs-3'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
