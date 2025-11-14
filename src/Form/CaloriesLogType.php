<?php

namespace App\Form;

use App\Entity\CaloriesLog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaloriesLogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'row_attr' => [
                    'class' => 'form-floating flex-grow-1 mb-3 m-lg-0',
                ]
            ])
            ->add('calories', IntegerType::class, [
                'label' => 'Calories (kcal)',
                'row_attr' => [
                    'class' => 'form-floating mb-3 m-lg-0',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CaloriesLog::class,
        ]);
    }
}
