<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $villes = ['St-Herblain', 'Hub Creatic', 'Rennes', 'Niort'];
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email', EmailType::class)
            ->add('date_embauche', DateType::class)
            ->add('ecole', ChoiceType::class, [
                'choices' => $villes,
                'choice_label' => function ($key, $value) {
                    return $key;
                }
            ])
            ->add('permis_valide', ChoiceType::class, [
                    'choices' => [
                        'Oui' => true,
                        'Non' => false
                    ]
                ]
            )
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_label' => 'Télécharger',
                'download_uri' => true,
                'image_uri' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
