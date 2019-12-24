<?php

namespace App\Repository;

use App\Entity\Module;
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


    // retourne la liste des modules de la gamme
    public function rechercheModuleGamme($gamm_id): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id, c.pers_nom, c.pers_prenom, c.pers_mail')
            ->where('c.pers_nom LIKE :recherche')
            ->orWhere('c.pers_prenom LIKE :recherche')
            ->orWhere('c.pers_mail LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%");
        return $qb->getQuery()->getResult();
    }

        // retourne la liste des modules de la gamme
        public function rechercheModuleDevis($devi_id): array
        {
            $qb = $this->createQueryBuilder('c')
                ->select('m.id, m.modu_nom, m.modu_prix_unitaire')
                ->where('m.devi_id = :devi_id')
                ->setParameter('devi_id', $devi_id);
            return $qb->getQuery()->getResult();
        }


}
