<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Devis;
use App\Entity\Utilisateur;
use App\Entity\Maison;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/devis")
 */
class DevisController extends AbstractController
{


    /** 
    * Permet de créer un devis et son adresse 
    * @Route("/", name="devis_creation", methods={"POST"}) 
    */
    public function creationDevis(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $parametersAsArray = [];
        $erreur = null;

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètres.";;
        } 
        //Creation du devis
        if  ($erreur == null) {
            //Recuperation de l'utilisateur
            $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
            $utilisateur = $repository_utilisateur->find($parametersAsArray['utilisateur_devis_id']);
			if ($utilisateur == null){
				$erreur == "Utilisateur inexistant";
            }
        }
        if ($erreur == null){
            //Recuperation de la maison
            $repository_maison = $this->getDoctrine()->getRepository(Maison::class); 
            $maison = $repository_maison->find($parametersAsArray['devis_maison_id']);
            if ($maison == null){
                $erreur == "Maison inexistante";
            }
        }

        //Creation du devis
		if ($erreur == null) {
            $devis = new Devis(); 
            $devis->setNomDevis($parametersAsArray['nom_devis']);
            $devis->setDateDevis(new \DateTime('@'.strtotime('now')));
            $devis->setPrixTotal(0);
            $devis->setDevisMaison($maison);
            $devis->setUtilisateurDevis($utilisateur); 
            $entityManager->persist($devis); 
            $entityManager->flush();
        }
		
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $devis->getId(), 
                'nom_devis' => $devis->getNomDevis(),
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
    * Permet d'avoir le detail d'un deviss 
    * @Route("/", name="devis_affichage", methods={"GET"});
    */
    public function affichageDevis(Request $requestjson) 
    {
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
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

        //On verifie si l'devis existe bien
        if ($erreur == null){
            $devis = $repository_devis->find($parametersAsArray['id']);
            if ($devis == null){
                $erreur = "Le devis n'existe pas.";
            }
        }

        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response(json_encode(array(
                'result' => "OK",
                'id' => $devis->getId(),
                'nom_devis' => $devis->getNomDevis(),
                'date_devis' => $devis->getDateDevis(),
                'prix_devis' => $devis->getPrixTotal(),
                'utilisateur_devis_id' => $devis->getUtilisateurDevis()->getId(),
                'devis_maison_id' => $devis->getDevisMaison()->getId(),
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
    * Permet de modifier un devis
    * @Route("/", methods={"PUT"}) 
    */
    public function modificationDevis(Request $requestjson){
        $entityManager = $this->getDoctrine()->getManager();  
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
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
        if  ($erreur == null) {
            //Recuperation maison
            $repository_maison = $this->getDoctrine()->getRepository(Maison::class);
            $maison = $repository_maison->find($parametersAsArray['devis_maison_id']);
            //Recuperation utilisateur
            $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
            $utilisateur = $repository_utilisateur->find($parametersAsArray['utilisateur_devis_id']);
            //Modification du devis 
            $devis = $repository_devis->find($parametersAsArray['id']); 
            $devis->setNomDevis($parametersAsArray['nom_devis']);
            $devis->setDateDevis(new \DateTime('@'.strtotime('now')));
            $devis->setUtilisateurDevis($utilisateur);
            $devis->setDevisMaison($maison);
            $entityManager->persist($devis); 
            $entityManager->flush();
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $devis->getId(), 
                'nom_devis' => $devis->getNomDevis(),
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
    * Permet de supprimer un devis
    * @Route("/", name="devis_suppression", methods={"DELETE"}),
    */
    public function suppressionDevis(Request $requestjson){
        $parametersAsArray = [];
        $erreur = null;
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        if ($parametersAsArray['id'] == null){
            $erreur = "Il n'y a pas de paramètre.";
        }else{
            $entityManager = $this->getDoctrine()->getManager(); 
            $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
            $devis = $repository_devis->find($parametersAsArray['id']);
            if ($devis == null) {
                $erreur = "Le devis n'existe pas.";
            } else {
                $entityManager->remove($devis);
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
                'id' => $parametersAsArray['id'],
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;        
    }

    /**
    * Permet d'avoir la liste de tous les devis 
    * @Route("/liste/", name="devis_liste", methods={"GET"});
    */
    public function listeDevis(Request $requestjson) 
    {
        $erreur = null;
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        //Recuperation de la liste de devis
        $listeDevis = $repository_devis->findAll();
        //Verification de la base
        if ($listeDevis == null) {
            $erreur = "Aucun devis trouvée.";
        }
        $listeReponse = array();
        foreach ($listeDevis as $devis) 
        {
            $utilisateur = $devis->getUtilisateurDevis();
            $listeReponse[] = array(
                'id' => $devis->getId(),
                'nom_devis' => $devis->getNomDevis(),
                'date_devis' => $devis->getDateDevis(),
                'prix_total' => $devis->getPrixTotal(),
                'id_utilisateur' => $utilisateur->getId(),
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),   
            );  
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                "listeDevis" => $listeReponse,
                )
            ));
        }else{
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
