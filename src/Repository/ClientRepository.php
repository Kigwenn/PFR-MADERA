<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
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
    public function findOneBySomeField($value): ?Client
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
    public function clientExistant($nom, $prenom, $mail): array
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

    //Vérification des parametres
    public function verificationParametre(array $parametresObligatoire, array $parametersAsArray): string
    {
        $resultat = "OK";
        if ($parametersAsArray == null){
            $resultat = "Il n'y a pas de paramètre.";
        } elseif (count($parametersAsArray) <> count($parametresObligatoire))
        {
            $resultat = "Il n'y a pas le bon nombre de paramètre (" . strval((count($parametersAsArray)) . 
                 " sur " . strval(count($parametresObligatoire)) . "). ");
        } else {
            foreach ($parametersAsArray as $key => $value){
                if (!in_array($key, $parametresObligatoire)) 
                {
                    $resultat = "Le paramètre " . strval($key) . " n'existe pas.";
                    break;
                }
            }
        }
        return $resultat;
    }

    // retourne la liste des client correspondant à la recherche
    public function rechercheClients($recherche): array
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id, c.pers_nom, c.pers_prenom, c.pers_mail')
            ->where('c.pers_nom LIKE :recherche')
            ->orWhere('c.pers_prenom LIKE :recherche')
            ->orWhere('c.pers_mail LIKE :recherche')
            ->setParameter('recherche', "%" . $recherche . "%");
        return $qb->getQuery()->getResult();
    }
}
