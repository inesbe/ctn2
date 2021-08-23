<?php

namespace App\Repository;

use App\Entity\CommentairesMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentairesMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentairesMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentairesMedia[]    findAll()
 * @method CommentairesMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentairesMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentairesMedia::class);
    }

    // /**
    //  * @return CommentairesMedia[] Returns an array of CommentairesMedia objects
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
    public function findOneBySomeField($value): ?CommentairesMedia
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
