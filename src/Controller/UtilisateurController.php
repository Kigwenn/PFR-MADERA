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
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
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
                    $erreur = "Utilisateur déjà existant.";
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
            $adresse->setAdreRue($parametersAsArray['rue_adresse']);
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

    /**
    * Permet d'avoir le detail d'un utilisateurs 
    * @Route("/", name="utilisateur_affichage", methods={"GET"});
    */
    public function affichageUtilisateur(Request $requestjson) 
    {
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }

        //On verifie si l'utilisateur existe bien
        if ($erreur == null){
            $utilisateur = $repository_utilisateur->find($parametersAsArray['id']);
            if ($utilisateur == null){
                $erreur = "L'utilisateur n'existe pas.";
            }
        }

        //Envoi de la réponse 
        if  ($erreur == null) { 
            $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class);  
            $adresse = $repository_adresse->find($utilisateur->getAdresseUtilisateur());
            $reponse = new Response(json_encode(array(
                'result' => "OK",
                'id' => $utilisateur->getId(),
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                'mail_utilisateur' => $utilisateur->getMailUtilisateur(),
                'tel_utilisateur' => $utilisateur->getTelUtilisateur(),
                'type_utilisateur_id' => $utilisateur->getTypeUtilisateur()->getId(),
                'rue_adresse' => $adresse->getAdreRue(),
                'ville_adresse' => $adresse->getVilleAdresse(),
                'cp_adresse' => $adresse->getCpAdresse(),
                'region_adresse' => $adresse->getRegionAdresse(),
                ))
            );
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

    /** 
    * Permet de modifier un utilisateur et son adresse
    * @Route("/", methods={"PUT"}) 
    */
    public function modificationUtilisateur(Request $requestjson){
        $entityManager = $this->getDoctrine()->getManager();  
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
        $parametersAsArray = [];
        $erreur = null;

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }

        // On verifie si il n'y a pas déjà un utilisateur existant avec ces parametres
        $listeUtilisateurs = $repository_utilisateur->findAll();
        if ($erreur == null) {
            foreach ($listeUtilisateurs as $utilisateur) 
            {
                $typeUtilisateur = $utilisateur->getTypeUtilisateur();
                if (($utilisateur->getId() != $parametersAsArray['id']) &&
                ($utilisateur->getNomUtilisateur() == $parametersAsArray['nom_utilisateur']) &&
                ($utilisateur->getPrenomUtilisateur() == $parametersAsArray['prenom_utilisateur']) && 
                ($utilisateur->getMailUtilisateur() == $parametersAsArray['mail_utilisateur'])){
                    $erreur = "Utilisateur deja existant.";
                    break;       
                }
            }
        }

        if  ($erreur == null) {
            //Modification de l'utilisateur 
            $utilisateur = $repository_utilisateur->find($parametersAsArray['id']); 
            $utilisateur->setNomUtilisateur($parametersAsArray['nom_utilisateur']);
            $utilisateur->setPrenomUtilisateur($parametersAsArray['prenom_utilisateur']);
            $utilisateur->setMailUtilisateur($parametersAsArray['mail_utilisateur']);
            $utilisateur->setTelUtilisateur($parametersAsArray['tel_utilisateur']);
            $utilisateur->setMdpUtilisateur($parametersAsArray['mdp_utilisateur']);
            $entityManager->persist($utilisateur); 
            
            //Modification de l'adresse
            $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class); 
            $adresse = $repository_adresse->find($utilisateur->getAdresseUtilisateur());
            $adresse->setAdreRue($parametersAsArray['rue_adresse']);
            $adresse->setVilleAdresse($parametersAsArray['ville_adresse']);
            $adresse->setCpAdresse($parametersAsArray['cp_adresse']);
            $adresse->setRegionAdresse($parametersAsArray['region_adresse']);
            $entityManager->persist($adresse);
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


    /** 
    * Permet de supprimer un utilisateur et son adresse grâce à l'id de l'utilisateur
    * @Route("/", name="utilisateur_suppression", methods={"DELETE"}),
    */
    public function suppressionUtilisateur(Request $requestjson){
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }else{
            $entityManager = $this->getDoctrine()->getManager(); 
            $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
            $utilisateur = $repository_utilisateur->find($parametersAsArray['id']);
            if ($utilisateur == null) {
                $erreur = "L'utilisateur n'existe pas.";
            } else {
                $entityManager->remove($utilisateur);
                $entityManager->flush();  
            }
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $parametersAsArray['id'],
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;        
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste/", name="utilisateur_liste", methods={"GET"});
    */
    public function listeUtilisateur(Request $requestjson) 
    {
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }else{
            $entityManager = $this->getDoctrine()->getManager(); 
            $repository_typeUtilisateur = $this->getDoctrine()->getRepository(TypeUtilisateur::class); 
            $typeUtilisateur = $repository_typeUtilisateur->find($parametersAsArray['type_utilisateur_id']);
            if ($typeUtilisateur == null) {
                $erreur = "Le type utilisateur n'existe pas.";
            }else{
                $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
                $listeUtilisateurs = $repository_utilisateur->findAll();
                $listeReponse = array();
                foreach ($listeUtilisateurs as $utilisateur) 
                {
                    // on enregistre les utilisateur correspondant au type mis en paramètre
                    if ($parametersAsArray['type_utilisateur_id'] == $utilisateur->getTypeUtilisateur()->getId()){
                        $listeReponse[] = array(
                            'id' => $utilisateur->getId(),
                            'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                            'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                            'mail_utilisateur' => $utilisateur->getMailUtilisateur(),
                            'tel_utilisateur' => $utilisateur->getTelUtilisateur(),
                        );
                    }
                }
            }
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'type_utilisateur_id' => $parametersAsArray['type_utilisateur_id'],
                "listeUtilisateurs" => $listeReponse,
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs contenant le mot en parametre dans leur nom/prenom/mail 
    * @Route("/recherche/", name="utilisateur_recherche", methods={"GET"});
    */
    public function rechercheUtilisateurs(Request $requestjson) 
    {
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }else {
            $entityManager = $this->getDoctrine()->getManager(); 
            $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
            $listeUtilisateurs = $repository_utilisateur->findAll();
            $listeReponse = array();
            foreach ($listeUtilisateurs as $utilisateur) 
            {
                // on enregistre les utilisateur correspondant au paramètre
                if ((strpos($utilisateur->getNomUtilisateur(), $parametersAsArray['recherche']) !== false) ||
                (strpos($utilisateur->getPrenomUtilisateur(), $parametersAsArray['recherche']) !== false) ||
                (strpos($utilisateur->getMailUtilisateur(), $parametersAsArray['recherche']) !== false) ){
                    $listeReponse[] = array(
                        'id' => $utilisateur->getId(),
                        'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                        'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                        'mail_utilisateur' => $utilisateur->getMailUtilisateur(),
                        'tel_utilisateur' => $utilisateur->getTelUtilisateur(),
                    );
                }
            }
            if ($listeReponse == null){
                $erreur = "Aucuns résultats."; 
            }  
        }

        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'recherche' => $parametersAsArray['recherche'],
                "listeUtilisateurs" => $listeReponse,
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
                'recherche' => $parametersAsArray['recherche'],
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }


    /**
    * Permet d'avoir les devis d'un utilisateur grâce à son id 
    * @Route("/devis/", name="utilisateur_devis", methods={"GET"}) 
    */
    public function devisUtilisateur(Request $requestjson)
    {
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        }else{
            $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
            $utilisateur = $repository_utilisateur->find($parametersAsArray['id']);
            if ($utilisateur == null){
                $erreur = "L'utilisateur n'existe pas.";
            }else{
                //Recuperation des devis 
                $listeDevis = $utilisateur->getDevis(); 
                $listeReponse = [];
                foreach ($listeDevis as $devis) 
                { 
                    $listeReponse [] = array(
                        "id" => $devis->getId(), 
                        "nom_devis" => $devis->getNomDevis(),
                        "date_devis" => $devis->getDateDevis(),
                        "prix_total" => $devis->getPrixTotal(),
                    );
                }
            }
        } 
        //Envoi de la réponse 
        if  ($erreur == null) {
            $reponse = new Response(json_encode(array(
                'result' => "OK",
                'id_utilisateur' => $utilisateur->getId(),
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                'listeDevis' => $listeReponse, 
                ))
            );
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
