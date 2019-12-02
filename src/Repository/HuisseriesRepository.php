<?php

namespace App\Repository;

use App\Entity\Huisseries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Huisseries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Huisseries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Huisseries[]    findAll()
 * @method Huisseries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HuisseriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Huisseries::class);
    }

    // /**
    //  * @return Huisseries[] Returns an array of Huisseries objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Huisseries
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
