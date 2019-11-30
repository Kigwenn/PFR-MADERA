<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeUtilisateur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/type_utilisateur", name="type_utilisateur")
 */
class TypeUtilisateurController extends AbstractController
{
        /**
    * Permet d'avoir la liste de tous les typeUtilisateur 
    * @Route("/liste/", name="typeUtilisateur_liste", methods={"GET"});
    */
    public function listeTypeUtilisateur() 
    {
        $erreur = null;
        $repository_typeUtilisateur = $this->getDoctrine()->getRepository(TypeUtilisateur::class);
        //Recuperation de la liste de typeUtilisateur
        $listeTypeUtilisateur = $repository_typeUtilisateur->findAll();
        //Verification de la base
        if ($listeTypeUtilisateur == null) {
            $erreur = "Aucun typeUtilisateur trouvé.";
        }
        $listeReponse = array();
        foreach ($listeTypeUtilisateur as $typeUtilisateur) 
        {
            $listeReponse[] = array(
                'id' => $typeUtilisateur->getId(),
                'nom_type' => $typeUtilisateur->getNomType(),
            );  
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                "listeTypeUtilisateur" => $listeReponse,
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
