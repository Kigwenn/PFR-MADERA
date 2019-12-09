<?php

namespace App\Repository;

use App\Entity\Remplissage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Remplissage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remplissage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remplissage[]    findAll()
 * @method Remplissage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemplissageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remplissage::class);
    }

    // /**
    //  * @return Remplissage[] Returns an array of Remplissage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Remplissage
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
