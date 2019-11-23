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

    /**
    * Permet d'avoir la liste de tous les modules 
    * @Route("/modules/", name="gamme_modules", methods={"GET"});
    */
    public function listeModules(Request $requestjson) 
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
            $repository_gamme = $this->getDoctrine()->getRepository(Gamme::class); 
            $gamme = $repository_gamme->find($parametersAsArray['gamme_module_id']);
            if ($gamme == null) {
                $erreur = "La gamme n'existe pas.";
            }else{
                //Recupérattion des modules
                $listeModules = $gamme->getModules();
                //Verification de la base
                if ($listeModules == null) {
                    $erreur = "Aucun module trouvé.";
                }else{
                    $listeReponse = array();
                    foreach ($listeModules as $module) 
                    {
                        $listeReponse[] = array(
                            'id' => $module->getId(),
                            'nom_module' => $module->getNomModule(),
                        );
                    }
                }
            }
        }
        //Envoi de la réponse 
        if  ($erreur == null) { 
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'gamme_module_id' => $parametersAsArray['gamme_module_id'],
                "listeModules" => $listeReponse,
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
}
