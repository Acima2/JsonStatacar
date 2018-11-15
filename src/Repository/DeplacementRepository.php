<?php

namespace App\Repository;

use App\Entity\Deplacement;
use App\Entity\User;
use App\Entity\Vehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * @method Deplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deplacement[]    findAll()
 * @method Deplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeplacementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Deplacement::class);
    }

    /**
     * @param User $user
     * @return Deplacement
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getActiveDeplacementForUser(User $user) {
        $qb = $this->createQueryBuilder('d')
            ->join('d.chauffeur', 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $user->getId())
            ->setMaxResults(1)
            ->orderBy('d.date_retour');

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param User $user
     * @return bool
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function hasActiveDeplacementForUser(User $user) {
        $qb = $this->createQueryBuilder('d')
            ->join('d.chauffeur', 'c')
            ->andWhere('c.id = :id')
            ->andWhere('d.date_retour IS NULL');
        try {
            $qb->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return false;
        }
        return true;
    }


    //get last kilometrage for vehicule -> dernier kilometrage du déplacement
    //jointure déplacement et vehicule récupérer le max check par date

    public function getKilometrageVehicule(Vehicule $vehicule) {
        $qb = $this->createQueryBuilder('d')
            ->join('d.vehicule', 'v')
            ->andWhere('d.vehicule = :id')
            ->setParameter('id', $vehicule->getId())
            ->setMaxResults(1)
            ->orderBy('d.date_retour' , 'desc')
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult()->getKilometrageRetour();
    }

//    /**
//     * @return Deplacement[] Returns an array of Deplacement objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deplacement
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
