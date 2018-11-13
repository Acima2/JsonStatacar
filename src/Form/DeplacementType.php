<?php

namespace App\Form;

use App\Entity\Deplacement;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeplacementType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $villes = ['St-Herblain', 'Hub Creatic', 'Rennes', 'Niort'];
        $deplacements = ['Cours', 'Réunion', 'Course', 'Déchèterie', 'Garage', 'Commercial', 'Assistance technique', 'Divers', 'Régulation'];
        $builder
            ->add('date_depart', DateTimeType::class, ['label' => 'Date de départ'])
            ->add('date_retour',DateTimeType::class, ['label' => 'Date de retour'])
            ->add('kilometrage_depart', IntegerType::class)
            ->add('kilometrage_retour', IntegerType::class)
            ->add('lieu_depart', ChoiceType::class, [
                'choices' => $villes,
                'choice_label' => function ($key, $value) {
                    return $key;
                },
                'placeholder' => 'Ville',
                'label' => 'Lieux de départ',
            ])
            ->add('lieu_retour', ChoiceType::class, [
                'choices' => $villes,
                'choice_label' => function ($key, $value) {
                    return $key;
                },
                'placeholder' => 'Ville',
                'label' => 'Lieux de retour',
            ])
            ->add('vehicule', EntityType::class, [
                'label' => 'Véhicule utilisé',
                'class' => Vehicule::class,
                'choice_label' => 'nom',
                'expanded' => false,
                'multiple' => false
            ])
            ->add('nature', ChoiceType::class, [
                'choices' => $deplacements,
                'choice_label' => function ($key, $value) {
                    return $key;
                },
                'label' => 'Nature du déplacement',
            ])
            ->add('pleins_carburant', ButtonType::class, [
                'label' => "J'ai fait le plein"
            ])
            ->add('commentaire', TextareaType::class, [
                'label' => 'Commentaires',
                'attr' => array(
                    'placeholder' => 'Ex: Il y avait des chips écrasées sur le siège, un pigeon s\'est fait plaisir sur le pare-brise, etc...')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deplacement::class,
        ]);
    }
}
