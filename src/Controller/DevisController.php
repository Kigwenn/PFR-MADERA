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

    




}
