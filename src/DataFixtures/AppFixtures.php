<?php

namespace App\DataFixtures;

use App\Entity\Deplacement;
use App\Entity\Vehicule;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Faker\Provider\Fakecar;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{

    private $passwordEncoder;
    private $userRepository;
    private $vehiculeRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository, VehiculeRepository $vehiculeRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->vehiculeRepository = $vehiculeRepository;
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
            $vehicule->setDateAchat($faker->dateTime("now"));
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
            $user->setDateEmbauche($faker->dateTime("now"));
            $user->setPermisValide($faker->boolean(20));
            $manager->persist($user);
        }
        $manager->flush();

        $tableauxVehicules = $this->vehiculeRepository->findAll();
        $tableauxUtilisateur = $this->userRepository->findAll();
        $tailleUtilisateur = count($tableauxUtilisateur);


        foreach ($tableauxVehicules as $vehicule) {
            /* Initialiser */
            $kilometrage = $faker->numberBetween($min = 1000, $max = 200000);
            $date = $faker->dateTime("now");
            $nbrDeplacements = $faker->numberBetween($min=0, $max=2);

            for($i=0; $i<$nbrDeplacements; $i++) {
                /* On prend un $user au pif */
                $user= $tableauxUtilisateur[$faker->numberBetween(0,$tailleUtilisateur-1)];
                /* On crée un nouveau déplacement */
                $deplacement = new Deplacement();
                $deplacement->setVehicule($vehicule);
                $deplacement->setChauffeur($user);
                $deplacement->setKilometrageDepart($kilometrage);
                $deplacement->setDateDepart($date);
                /* A compléter ... */
                /* On gère la fin du déplacement */
                $kilometrage = $kilometrage + $faker->numberBetween(1, 1000);
                $date = $date+$faker
                $deplacement->setKilometrageRetour($kilometrage);

            }


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
