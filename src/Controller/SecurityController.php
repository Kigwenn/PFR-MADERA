<?php

namespace App\Controller;

use App\Entity\TypeUtilisateur;
use App\Entity\Utilisateur;
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
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
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
                $typeUtilisateur = $utilisateur->getTypeUtilisateur(); //getMailUtilisateur
                if (($utilisateur->getMailUtilisateur() == $parametersAsArray['mail_utilisateur']) && 
                ($utilisateur->getMdpUtilisateur() == $parametersAsArray['mdp_utilisateur'])){
                    //utilisateur autorisé, on créé son token
                    $time = new \datetime("now");  
                    $utilisateur->setTokenUtilisateur(bin2hex(random_bytes(32)));
                    $utilisateur->setDateTokenUtilisateur($time);
                    $entityManager->persist($utilisateur);
                    $entityManager->flush();

                    //Envoi de la réponse 
                    if  ($erreur == null) { 
                        $reponse = new Response (json_encode(array(
                        'result' => "OK",
                        'id' => $utilisateur->getId(), 
                        'mail_utilisateur' => $utilisateur->getMailUtilisateur(), 
                        'token_utilisateur' => $utilisateur->getTokenUtilisateur(),
                        'datetoken_utilisateur' => $utilisateur->getDateTokenUtilisateur()
                    )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
                }
                else{
                    $erreur = "Il n'y a pas d'utilisateurs avec ces identifiants";
                }
            }
        }
    }
    /** 
    * Permet de se déconnecter de l'application 
    * @Route("/logout", name="logout", methods={"POST"}) 
    */
    public function logout(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
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
