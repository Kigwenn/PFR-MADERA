<?php

namespace App\Repository;

use App\Entity\DocMaison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DocMaison|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocMaison|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocMaison[]    findAll()
 * @method DocMaison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocMaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DocMaison::class);
    }

    // /**
    //  * @return DocMaison[] Returns an array of DocMaison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DocMaison
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
