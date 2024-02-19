<?php

namespace App\Form;

use App\Entity\User;
use App\Enums\TimezoneEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileDataFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        $builder
        ->add('email', EmailType::class, [
            'label' => 'New email address:',
            'required' => false,
            'attr' => [
                'autocomplete' => 'email',
                'class' => 'form-control',
                'aria-describedby' => 'emailHelp',
            ]
        ])
        ->add('name', TextType::class, [
            'label' => 'New name:',
            'required' => false,
            'attr' => [
                'class' => 'form-control',
                'style' => 'margin-top: 5px;',
                'aria-describedby' => 'emailHelp',
            ]
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => false,
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control',
            ],
            'constraints' => [
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
            'first_options' => ['label' => 'New password:',
                            'attr' => [
                                'autocomplete' => 'new-password',
                                'class' => 'form-control',
                                'style' => 'margin-top: 5px;',
                                ]
                            ],
            'second_options' => ['label' => 'Repeat new password:',
                            'attr' => [
                                'autocomplete' => 'new-password',
                                'class' => 'form-control',
                                'style' => 'margin-top: 5px;',
                                ]
                            ],
            ])
            ->add('newTimezone', ChoiceType::class, [
                'mapped' => false,
                'choices' => TimezoneEnum::getArray(),
                                'choice_label' => function (string $choice) {
                    return $choice;
                },
                'preferred_choices' => [$options['data']->getTimezone()],
                'duplicate_preferred_choices' => false,
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
            ->add('currentPassword', PasswordType::class, [
                'mapped' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new UserPassword([
                        'message' => 'Wrong value for your current password',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
