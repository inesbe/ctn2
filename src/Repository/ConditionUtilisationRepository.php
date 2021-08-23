<?php

namespace App\Repository;

use App\Entity\ConditionUtilisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConditionUtilisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConditionUtilisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConditionUtilisation[]    findAll()
 * @method ConditionUtilisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConditionUtilisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConditionUtilisation::class);
    }

    // /**
    //  * @return ConditionUtilisation[] Returns an array of ConditionUtilisation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConditionUtilisation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
