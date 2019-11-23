<?php

namespace App\Controller;

use App\Entity\TypeUtilisateur;
use App\Entity\Utilisateur;
use App\Entity\Adresse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="utilisateur")
     * 
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /** 
    * Permet de créer un utilisateur et son adresse 
    * @Route("/", name="utilisateur_creation", methods={"POST"}) 
    */
    public function creationUtilisateur(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
        $parametersAsArray = [];
        $erreur = null;

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $utilisateurValide = true;
        foreach ($parametersAsArray as $valeurParametre) {
            if ($valeurParametre == null) {
                $erreur = "Un parametre est vide.";
                break; 
            }
        } 
        // On verifie si il n'y a pas déjà un utilisateur existant
        $listeUtilisateurs = $repository_utilisateur->findAll();
        if ($erreur == null) {
            foreach ($listeUtilisateurs as $utilisateur) 
            {
                $typeUtilisateur = $utilisateur->getTypeUtilisateur();
                if (($typeUtilisateur->getId() == $parametersAsArray['type_utilisateur_id']) && 
                ($utilisateur->getNomUtilisateur() == $parametersAsArray['nom_utilisateur']) &&
                ($utilisateur->getPrenomUtilisateur() == $parametersAsArray['prenom_utilisateur']) && 
                ($utilisateur->getMailUtilisateur() == $parametersAsArray['mail_utilisateur'])){
                    $erreur = "Utilisateur deja existant.";
                    break;       
                }
            }
        }
        //Creation de l'utilisateur
        if  ($erreur == null) {
            //Recuperation du type d'utilisateur
            $repository_typeUtilisateur = $this->getDoctrine()->getRepository(TypeUtilisateur::class); 
            $typeUtilisateur = $repository_typeUtilisateur->find($parametersAsArray['type_utilisateur_id']);
            //Creation de l'adresse
            $adresse = new Adresse();
            $adresse->setRueAdresse($parametersAsArray['rue_adresse']);
            $adresse->setVilleAdresse($parametersAsArray['ville_adresse']);
            $adresse->setCpAdresse($parametersAsArray['cp_adresse']);
            $adresse->setRegionAdresse($parametersAsArray['region_adresse']);
            $entityManager->persist($adresse);
            //Creation de l'utilisateur
            $utilisateur = new Utilisateur(); 
            $utilisateur->setNomUtilisateur($parametersAsArray['nom_utilisateur']);
            $utilisateur->setPrenomUtilisateur($parametersAsArray['prenom_utilisateur']);
            $utilisateur->setMailUtilisateur($parametersAsArray['mail_utilisateur']);
            $utilisateur->setTelUtilisateur($parametersAsArray['tel_utilisateur']);
            $utilisateur->setMdpUtilisateur($parametersAsArray['mdp_utilisateur']);
            $utilisateur->setTypeUtilisateur($typeUtilisateur);
            $utilisateur->setAdresseUtilisateur($adresse); 
            $entityManager->persist($utilisateur); 
            $entityManager->flush();
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $utilisateur->getId(), 
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(), 
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
