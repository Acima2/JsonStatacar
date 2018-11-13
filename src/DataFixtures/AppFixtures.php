<?php

namespace App\DataFixtures;

use App\Entity\Vehicule;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Fakecar;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

//Création d'un jeu de fausses données pour remplir la table Vehicule

    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Fakecar($faker));

        // on créé 20 véhicules
        for ($i = 0; $i < 20; $i++) {
            $vehicule = new Vehicule();
            $vehicule->setNom($faker->vehicle);
            $vehicule->setMarque($faker->vehicleBrand);
            $vehicule->setModele($faker->vehicleModel);
            $vehicule->setImmatriculation($faker->vehicleRegistration);
            $vehicule->setDateAchat($faker->dateTime);
            $vehicule->setResponsableCle($faker->name);
            $vehicule->setResponsableEntretien($faker->name);
            $manager->persist($vehicule);
        }

            // on créé un admin avec de vraies données
            $admin = new User();
            $admin->setNom('Admini');
            $admin->setPrenom('Strateur');
            $admin->setEcole('Rennes');
            $admin->setEmail('maelan.leborgne@gmail.com');
            $admin->setRoles(['ADMIN_ROLE']);
            $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'maelan'));
            $admin->setDateEmbauche($faker->dateTime);
            $admin->setPermisValide('true');
            $manager->persist($admin);


        // on créé 20 personnes
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setNom($faker->name);
            $user->setPrenom($faker->firstName);
            $user->setEcole($faker->city);
            $user->setEmail($faker->email);
            $user->setRoles(['USER_ROLE']);
            $user->setPassword($faker->password());
            $user->setDateEmbauche($faker->dateTime);
            $user->setPermisValide($faker->boolean(20));
            $manager->persist($user);
        }

        $manager->flush();
    }

//Création d'un jeu de fausses données pour remplir la table User


}
