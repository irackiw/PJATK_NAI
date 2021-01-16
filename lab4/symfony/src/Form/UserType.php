<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Rate;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'user',
                EntityType::class,
                [
                    'class' => User::class,
                    'choice_label' => 'name',
                ])
            ->add(
                'order',
                ChoiceType::class,
                [
                    'choices' => [
                        'Best' => 'desc',
                        'Worst' => 'asc'
                    ]
                ]
            )
            ->add(
                'limit',
                ChoiceType::class,
                [
                    'choices' => [
                        3 => 3,
                        5 => 5,
                        10 => 10,
                    ]
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'Get user recommendations',
                ]
            );
    }
}