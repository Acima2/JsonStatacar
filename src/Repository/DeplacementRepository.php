<?php

namespace App\Repository;

use App\Entity\Deplacement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
