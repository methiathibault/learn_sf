<?php

namespace App\Form;

use App\Entity\Color;
use App\Entity\Fruit;
use App\Entity\Gout;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FruitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country')
            ->add('weight')
            ->add('colors', EntityType::class, [
                'class' => Color::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('name')
            ->add('gout', EntityType::class, [
                'class' => Gout::class,
                'choice_label' => 'name',
                'multiple' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fruit::class,
        ]);
    }
}
