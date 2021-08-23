<?php

namespace App\Repository;

use App\Entity\BureauRelation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BureauRelation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BureauRelation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BureauRelation[]    findAll()
 * @method BureauRelation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BureauRelationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BureauRelation::class);
    }

    // /**
    //  * @return BureauRelation[] Returns an array of BureauRelation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BureauRelation
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
