<?php

namespace App\Repository;

use App\Entity\Chassis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Chassis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chassis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chassis[]    findAll()
 * @method Chassis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChassisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chassis::class);
    }

    // /**
    //  * @return Chassis[] Returns an array of Chassis objects
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
    public function findOneBySomeField($value): ?Chassis
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
