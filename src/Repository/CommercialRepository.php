<?php

namespace App\Repository;

use App\Entity\Commercial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Commercial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commercial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commercial[]    findAll()
 * @method Commercial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommercialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commercial::class);
    }

    // /**
    //  * @return Commercial[] Returns an array of Commercial objects
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
    public function findOneBySomeField($value): ?Commercial
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // retourne l'id du client si il existe
    public function commercialExistant($nom, $prenom, $mail): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.pers_nom = :nom')
            ->andWhere('c.pers_prenom = :prenom')
            ->andWhere('c.pers_mail = :mail')
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->setParameter('mail', $mail);
        return $qb->getQuery()->getResult();
    }

    // Verification connexion
    public function verificationConnexion($mail, $mdp): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.pers_mail = :mail')
            ->andWhere('c.comm_mdp = :mdp')
            ->setParameter('mail', $mail)
            ->setParameter('mdp', $mdp);
        return $qb->getQuery()->getResult();
    }

    // Verification dU Token
    public function verificationToken($id, $token): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id')
            ->where('c.id = :id')
            ->andWhere('c.comm_token = :token')
            ->setParameter('id', $id)
            ->setParameter('token', $token);
        return $qb->getQuery()->getResult();
    }
}
