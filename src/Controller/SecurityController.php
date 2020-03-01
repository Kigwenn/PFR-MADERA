<?php

namespace App\Controller;

use App\Entity\Commercial;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security")
 */
class SecurityController extends AbstractController
{
    /**
     * Permet de se connecter à l'application
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        $parametersAsArray = [];
        $erreur = null;

        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        } else {
            $CommercialId = $repository_commercial->verificationConnexion($parametersAsArray['mail_utilisateur'], $parametersAsArray['mdp_utilisateur']);
          
            if ($CommercialId == null) {
                $erreur = "Il n'y a pas d'utilisateurs avec ces identifiants";
            }else{
                //utilisateur autorisé, on créé son token
                $time = new datetime("now");
                $token = bin2hex(random_bytes(32));
                $queryBuilder = $entityManager->createQueryBuilder();
                $queryBuilder
                    ->update('App\Entity\Commercial', 'c')
                    ->set('c.comm_token', '?1')
                    ->set('c.comm_token_date', '?2')
                    ->where('c.id = ?3')
                    ->setParameter('1', $token)
                    ->setParameter('2', $time->format('Y-m-d H:i:s'))
                    ->setParameter('3', $CommercialId[0]['id']);
                $query = $queryBuilder->getQuery();
                $query->getDQL();
                $query->execute();

                $reponse = new Response (json_encode(array(
                    'result' => "OK",
                    'id' => $CommercialId[0]['id'],
                    'mail_utilisateur' => $parametersAsArray['mail_utilisateur'],
                    'token_utilisateur' => $token,
                    'datetoken_utilisateur' => $time->format('Y-m-d H:i:s')
                )));
            }
        }

        if ($erreur <> null){
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
            )));
        }

        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access Control-Allow-Origin", "*");
        return $reponse;
    }

    /**
     * Permet de se déconnecter de l'application
     * @Route("/logout", name="logout", methods={"POST"})
     */
    public function logout(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository_utilisateur = $this->getDoctrine()->getRepository(Commercial::class);
        $parametersAsArray = [];
        $erreur = null;

        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }
        // On verifie si l'utilisateur existe
        $listeUtilisateurs = $repository_utilisateur->findAll();
        if ($erreur == null) {
            foreach ($listeUtilisateurs as $utilisateur)
            {
                $typeUtilisateur = $utilisateur->getTypeUtilisateur();
                if (($utilisateur->getTokenUtilisateur() == $parametersAsArray['token_utilisateur'])){
                    //utilisateur authorisé, on créé son token
                    $utilisateur->setTokenUtilisateur(null);
                    $utilisateur->setDateTokenUtilisateur(null);
                    $entityManager->persist($utilisateur);
                    $entityManager->flush();

                    //Envoi de la réponse
                    if  ($erreur == null) {
                        $reponse = new Response (json_encode(array(
                                'result' => "OK",
                            )
                        ));
                    }
                    $reponse->headers->set("Content-Type", "application/json");
                    $reponse->headers->set("Access Control-Allow-Origin", "*");
                    return $reponse;
                }
                else{
                    $erreur = "Il n'y a pas d'utilisateurs avec ce token";
                }
            }
        }
    }
}
