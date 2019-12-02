<?php

namespace App\Repository;

use App\Entity\ComposantModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComposantModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComposantModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComposantModule[]    findAll()
 * @method ComposantModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComposantModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComposantModule::class);
    }

    // /**
    //  * @return ComposantModule[] Returns an array of ComposantModule objects
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
    public function findOneBySomeField($value): ?ComposantModule
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
