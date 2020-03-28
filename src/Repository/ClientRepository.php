<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Commercial;
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

    // retourne le client 
    public function findByRecuperationClient($id): array
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->setParameter('id', $id);
        return $qb->getQuery()->getResult();
    }
    

    //Vérification des parametres et du token
    public function verificationParametre(array $parametresObligatoire, array $parametersAsArray): string
    {
        $resultat = "OK";
        //Vérification des parametres 
        $cpt = 0;
        if ($parametersAsArray == null){
            $resultat = "Il n'y a pas de paramètre.";
        } else {
            foreach ($parametersAsArray as $key => $value){
                if (in_array($key, $parametresObligatoire)) { $cpt++; }
            }
            if (count($parametresObligatoire) <> $cpt){
                $resultat = "Il manque " . strval(count($parametresObligatoire) - $cpt) . " paramètres.";
            }
        }

        //Verification du token
        if ($resultat == "OK") {
            // On verifie si le commercial existe
//            var_dump($parametersAsArray);
            if ((!array_key_exists('connection', $parametersAsArray)) or
            (!array_key_exists('loginId', $parametersAsArray['connection'])) or
            (!array_key_exists('loginToken', $parametersAsArray['connection']))) {
              $resultat = "Parametre de connexion manquant";  
            } else {
//                var_dump('toto');
                $commercial = $this->verificationToken($parametersAsArray['connection']['loginId'], $parametersAsArray['connection']['loginToken']);
                if ($commercial == null){
                    $resultat = "Le token n'existe pas.";
                } 
            }
        }
        return $resultat;
    }

    // retourne la liste des modules de la gamme
    public function verificationToken($id, $token): array
    {
        $rawSql = "SELECT c.id FROM commercial AS c WHERE c.id = :id AND c.comm_token = :token" ;
        $stmt = $this->getEntityManager()->getConnection()->prepare($rawSql);
        $stmt->execute(['id' => $id, 'token' => $token]);
        return $stmt->fetchAll();
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
