<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Gamme;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/gamme")
 */
class GammeController extends AbstractController
{
    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste/", name="gamme_liste", methods={"GET"});
    */
    public function listeGamme(Request $requestjson) 
    {
        $erreur = null;
        $repository_gamme = $this->getDoctrine()->getRepository(Gamme::class);
        //Recuperation de la liste de gamme
        $listeGammes = $repository_gamme->findAll();
        //Verification de la base
        if ($listeGammes == null) {
            $erreur = "Aucune gamme trouvée.";
        }
        $listeReponse = array();
        foreach ($listeGammes as $gamme) 
        {
            $listeReponse[] = array(
                'id' => $gamme->getId(),
                'nom_gamme' => $gamme->getNomGamme(),
            );  
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                "listeGammes" => $listeReponse,
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
