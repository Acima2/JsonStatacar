<?php

namespace App\Repository;

use App\Entity\PleinCarburant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PleinCarburant|null find($id, $lockMode = null, $lockVersion = null)
 * @method PleinCarburant|null findOneBy(array $criteria, array $orderBy = null)
 * @method PleinCarburant[]    findAll()
 * @method PleinCarburant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PleinCarburantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PleinCarburant::class);
    }

//    /**
//     * @return PleinCarburant[] Returns an array of PleinCarburant objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PleinCarburant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
