<?php

namespace App\Repository;

use App\Entity\Connaissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Connaissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Connaissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Connaissement[]    findAll()
 * @method Connaissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConnaissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Connaissement::class);
    }

    // /**
    //  * @return Connaissement[] Returns an array of Connaissement objects
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
    public function findOneBySomeField($value): ?Connaissement
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
