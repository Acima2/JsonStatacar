<?php

namespace App\Form;

use App\Entity\PleinCarburant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PleinCarburantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $deplacements = ['Cours', 'Réunion', 'Course', 'Déchèterie', 'Garage', 'Commercial', 'Assistance technique', 'Divers', 'Régulation'];
        $builder
            ->add('date')
            ->add('kilometrage')
            ->add('lieu')
            ->add('litrage')
            ->add('prix_litre')
            ->add('type_carburant')
            ->add('deplacement', ChoiceType::class, [
                'choices' => $deplacements,
                'choice_label' =>function ($key, $value) {
                    return $key;
                },
                'label' => 'Nature du déplacement',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PleinCarburant::class,
        ]);
    }
}


