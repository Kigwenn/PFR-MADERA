<?php

namespace App\Repository;

use App\Entity\Caracteristique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Caracteristique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caracteristique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caracteristique[]    findAll()
 * @method Caracteristique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caracteristique::class);
    }

    // /**
    //  * @return Caracteristique[] Returns an array of Caracteristique objects
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
    public function findOneBySomeField($value): ?Caracteristique
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // retourne la liste des caracteristiques du module
    public function rechercheCaracteristiqueModule($modu_id): array
    {
        $rawSql = "SELECT c.id, c.modu_id, c.cara_section, c.cara_hauteur, c.cara_longueur, c.cara_type_angle, c.cara_degre_angle " . 
            "FROM caracteristique AS c WHERE c.modu_id = :modu_id";

        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute(['modu_id' => $modu_id]);
        return $stmt->fetchAll();
    }
}
