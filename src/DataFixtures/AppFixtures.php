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
    private $villes;
    private $deplacements;
    private $tableauxVehicules;
    private $tableauxUtilisateur;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository, VehiculeRepository $vehiculeRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->vehiculeRepository = $vehiculeRepository;
        $this->villes = ['St-Herblain', 'Hub Creatic', 'Rennes', 'Niort'];
        $this->deplacements = ['Cours', 'Réunion', 'Course', 'Déchèterie', 'Garage', 'Commercial', 'Assistance technique', 'Divers', 'Régulation'];
    }

//Création d'un jeu de fausses données pour remplir la table Vehicule

    public function load(ObjectManager $manager)
    {

        // On configure dans quelles langues nous voulons nos données
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new Fakecar($faker));
        $tableauxUtilisateur = [];
        $tableauxVehicules = [];
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
            array_push($tableauxVehicules, $vehicule);
        }

        // on créé un admin avec de vraies données
        $admin = new User();
        $admin->setNom('Strateur');
        $admin->setPrenom('Admini');
        $admin->setEcole('Rennes');
        $admin->setEmail('admin@jsonstatacar.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setDateEmbauche($faker->dateTime);
        $admin->setPermisValide('true');
        $manager->persist($admin);
        array_push($tableauxUtilisateur, $admin);
        // on créé un user de base avec de vraies données
        $user = new User();
        $user->setNom('Zateur');
        $user->setPrenom('Utili');
        $user->setEcole('Rennes');
        $user->setEmail('user@jsonstatacar.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'user'));
        $user->setDateEmbauche($faker->dateTime);
        $user->setPermisValide('true');
        $manager->persist($user);
        array_push($tableauxUtilisateur, $user);


        // on créé 20 personnes
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setNom($faker->name);
            $user->setPrenom($faker->firstName);
            $user->setEcole($faker->randomElement($this->villes));
            $user->setEmail($faker->email);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($faker->password());
            $user->setDateEmbauche($faker->dateTime("now"));
            $user->setPermisValide($faker->boolean(20));
            $manager->persist($user);
            array_push($tableauxUtilisateur, $user);
        }
        $manager->flush();


        $tailleUtilisateur = count($tableauxUtilisateur);


        foreach ($tableauxVehicules as $vehicule) {
            /* Initialiser */
            $kilometrage = $faker->numberBetween($min = 1000, $max = 200000);
            $date = $faker->dateTime("now");
            $nbrDeplacements = $faker->numberBetween($min = 0, $max = 20);
            $now = new \DateTime();

            for ($i = 0; $i < $nbrDeplacements; $i++) {
                /* On prend un $user au pif */
                $user = $tableauxUtilisateur[$faker->numberBetween(0, $tailleUtilisateur - 1)];
                /* On crée un nouveau déplacement */
                $deplacement = new Deplacement();
                $deplacement->setVehicule($vehicule);
                $deplacement->setChauffeur($user);
                $deplacement->setKilometrageDepart($kilometrage);
                $deplacement->setDateDepart($date);
                $deplacement->setLieuDepart($faker->randomElement($this->villes));
                /* A compléter ... */
                /* On gère la fin du déplacement */
                $kilometrage = $kilometrage + $faker->numberBetween(1, 1000);
                $date = $faker->dateTimeInInterval($date, '+ 3 days');
                if ($date >= $now) {
                    $i = $nbrDeplacements;
                    $date = $now;
                }
                $deplacement->setKilometrageRetour($kilometrage);
                $deplacement->setDateRetour($date);
                $deplacement->setLieuRetour($faker->randomElement($this->villes));
                $deplacement->setNature($faker->randomElement($this->deplacements));
                $deplacement->setCommentaire($faker->text($maxNbChars = 100));
                $manager->persist($deplacement);
            }
        }


        $manager->flush();
    }

//Création d'un jeu de fausses données pour remplir la table User


}
