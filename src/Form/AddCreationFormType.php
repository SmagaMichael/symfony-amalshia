<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Creation;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Choice;

class AddCreationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => ' ',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Titre'
                ]
            ])
            // ->add('slug')
            ->add('picture', FileType::class, [
                'mapped' => false,
                'label' => ' ',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('date', DateType::class, [
                'label' => ' ',
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                ]

            ])
            ->add('description', null, [
                'label' => ' ',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description'
                ]
                ])

      
             ->add('category', EntityType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'form-control'
                ],
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Category::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Creation::class,
        ]);
    }
}
