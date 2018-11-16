<?php

namespace App\Form;

use App\Entity\Deplacement;
use App\Entity\Vehicule;
use App\Repository\DeplacementRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeplacementType extends AbstractType
{
    private $deplacementRepository;
    public function __construct(DeplacementRepository $deplacementRepository){
        $this->deplacementRepository = $deplacementRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $villes = ['St-Herblain', 'Hub Creatic', 'Rennes', 'Niort'];
        $deplacements = ['Cours', 'Réunion', 'Course', 'Déchèterie', 'Garage', 'Commercial', 'Assistance technique', 'Divers', 'Régulation'];
        $builder
            ->add('date_depart', DateTimeType::class, [
                'label' => 'Date de départ',
                'widget' => 'single_text',
                'html5' => true,
            ])
            ->add('date_retour',DateTimeType::class, [
                'label' => 'Date de retour',
                'widget' => 'single_text',
                'html5' => true,
                ])
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

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $vehicule = $event->getData()->getVehicule();
            $form = $event->getForm();
            if($vehicule) {
                $kilometrage = $this->deplacementRepository->getKilometrageVehicule($vehicule);
            }
            else {
                $kilometrage = 0;
            }
            // Get configuration & options of specific field
            $config = $form->get('kilometrage_depart')->getConfig();
            $options = $config->getOptions();
            $form->add(
            // Replace original field...
                'kilometrage_depart',
                IntegerType::class,
                // while keeping the original options...
                array_merge(
                    $options,
                    [
                        'data' => $kilometrage
                    ]
                )
            );
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deplacement::class,
        ]);
    }
}
