<?php

namespace App\Repository;

use App\Entity\Isolant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Isolant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Isolant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Isolant[]    findAll()
 * @method Isolant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsolantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Isolant::class);
    }

    // /**
    //  * @return Isolant[] Returns an array of Isolant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Isolant
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
