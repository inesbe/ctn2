<?php

namespace App\Repository;

use App\Entity\Vrack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vrack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vrack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vrack[]    findAll()
 * @method Vrack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VrackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vrack::class);
    }

    // /**
    //  * @return Vrack[] Returns an array of Vrack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vrack
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
