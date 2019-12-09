<?php

namespace App\Repository;

use App\Entity\FinitionExterieur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FinitionExterieur|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinitionExterieur|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinitionExterieur[]    findAll()
 * @method FinitionExterieur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinitionExterieurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinitionExterieur::class);
    }

    // /**
    //  * @return FinitionExterieur[] Returns an array of FinitionExterieur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FinitionExterieur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
