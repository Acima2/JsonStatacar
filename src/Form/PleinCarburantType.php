<?php

namespace App\Form;

use App\Entity\PleinCarburant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PleinCarburantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, [
                'label' => 'Date du plein',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('kilometrage',IntegerType::class, [
                'label' => 'Kilometrage au moment du plein'
            ])
            ->add('lieu', TextType::class, [
                'label' => 'Lieu du plein'
                ])
            ->add('litrage', NumberType::class, [
                'label' => 'Nombre de litres'
            ])
            ->add('prix_litre', MoneyType::class, [
                'label' => 'Prix du litre de carburant'
            ])
            ->add('type_carburant', ChoiceType::class, [
                'choices'  => array(
                    'Gasoil', 'SP-95', 'SP-98', 'SP-95 E10', 'GPL'),
                'choice_label' => function ($key, $value) {
                    return $key;
                },
                'placeholder' => 'Carburant',
                'label' => 'Type de carburant'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PleinCarburant::class,
        ]);
    }
}


