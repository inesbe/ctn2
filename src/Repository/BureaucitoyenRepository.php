<?php

namespace App\Repository;

use App\Entity\Bureaucitoyen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bureaucitoyen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bureaucitoyen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bureaucitoyen[]    findAll()
 * @method Bureaucitoyen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BureaucitoyenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bureaucitoyen::class);
    }

    // /**
    //  * @return Bureaucitoyen[] Returns an array of Bureaucitoyen objects
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
    public function findOneBySomeField($value): ?Bureaucitoyen
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
