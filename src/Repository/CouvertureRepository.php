<?php

namespace App\Repository;

use App\Entity\Couverture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Couverture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Couverture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Couverture[]    findAll()
 * @method Couverture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouvertureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Couverture::class);
    }

    // /**
    //  * @return Couverture[] Returns an array of Couverture objects
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
    public function findOneBySomeField($value): ?Couverture
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
