<?php

namespace App\Repository;

use App\Entity\Module;
use App\Entity\Gamme;
use App\Entity\TypeModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Module|null find($id, $lockMode = null, $lockVersion = null)
 * @method Module|null findOneBy(array $criteria, array $orderBy = null)
 * @method Module[]    findAll()
 * @method Module[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Module::class);
    }

    // /**
    //  * @return Module[] Returns an array of Module objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Module
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // retourne la liste des modules du devis
    public function rechercheModuleDevis($devi_id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT m.id, m.modu_nom, m.modu_prix_unitaire, m.modu_prix_total
             FROM App\Entity\Module m
             WHERE m.devi = :devi_id
             ORDER BY m.id'
        )->setParameters(array('devi_id'=> $devi_id));

        // returns an array of Product objects
        return $query->getResult();
    }

    // retourne la liste des modules de la gamme
    public function rechercheModuleFamille($tymo_id, $fiex_id, $fiin_id, $couv_id, $isol_id): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT m.id, m.modu_nom, m.modu_prix_unitair, m.modu_prix_total FROM App\Entity\Module m 
            WHERE 
                (m.tymo = :tymo_id) AND 
                (m.devi is null) AND
                ((m.fiex is null) OR (m.fiex = 1) OR (m.fiex = :fiex_id)) AND
                ((m.fiin is null) OR (m.fiin = 1) OR (m.fiin = :fiin_id)) AND
                ((m.couv is null) OR (m.couv = 1) OR (m.couv = :couv_id)) AND
                ((m.isol is null) OR (m.isol = 1) OR (m.isol = :isol_id))
             ORDER BY m.id ASC'
        )->setParameters(array('tymo_id'=> $tymo_id, 'fiex_id'=> $fiex_id, 'fiin_id' => $fiin_id,
         'couv_id' => $couv_id, 'isol_id' => $isol_id));

        // returns an array of Product objects
        return $query->getResult();
    }

}
