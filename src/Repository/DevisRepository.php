<?php

namespace App\Repository;

use App\Entity\Devis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Devis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devis[]    findAll()
 * @method Devis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devis::class);
    }

    // /**
    //  * @return Devis[] Returns an array of Devis objects
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
    public function findOneBySomeField($value): ?Devis
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    // retourne la liste des modules de la gamme
    public function rechercheDevisClient($clie_id): array
    {
        $rawSql = "SELECT d.id, d.devi_nom, d.devi_date, d.devi_prix FROM devis AS d WHERE d.clie_id = :clie_id";
        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute(['clie_id' => $clie_id]);
        return $stmt->fetchAll();
    }
}
