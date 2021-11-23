<?php

namespace App\Form;

use App\Entity\Creation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AddCreationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => ' ',
                'attr' => [
                    'class'=> 'form-control',
                     'placeholder'=> 'Titre'
                ]
            ])
            // ->add('slug')
            ->add('picture', FileType::class,[
                'mapped' => false,
                'label' => ' ',
                'attr' => [
                    'class'=> 'form-control',
                ]
            ])
            ->add('date', DateType::class, [
                'label' => ' ',
                'widget' => 'single_text',
                'attr' => [
                    'class'=> 'form-control',
                ]
                
            ])
            ->add('description', null, [
                'label' => ' ',
                'attr' => [
                    'class'=> 'form-control',
                    'placeholder'=> 'Description'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Creation::class,
        ]);
    }
}
