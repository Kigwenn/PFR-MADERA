<?php

namespace App\Repository;

use App\Entity\FinitionInterieur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FinitionInterieur|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinitionInterieur|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinitionInterieur[]    findAll()
 * @method FinitionInterieur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinitionInterieurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinitionInterieur::class);
    }

    // /**
    //  * @return FinitionInterieur[] Returns an array of FinitionInterieur objects
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
    public function findOneBySomeField($value): ?FinitionInterieur
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
