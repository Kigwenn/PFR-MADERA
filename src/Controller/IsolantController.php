<?php

namespace App\Controller;
use App\Entity\Isolant;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IsolantController extends AbstractController
{
    /**
     * @Route("/isolant", name="isolant")
     */
    public function index()
    {
        return $this->render('isolant/index.html.twig', [
            'controller_name' => 'IsolantController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les isolant
    * @Route("/liste", name="isolant_liste", methods={"GET"});
    */
    public function listeIsolant(Request $requestjson) 
    {
        $repository_isolant = $this->getDoctrine()->getRepository(Isolant::class);
        //Recuperation de la liste de isolant
        $listeIsolant = $repository_isolant->findAll();
        // on vérifie si il y a bien une liste de isolant
        if ($listeIsolant == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeIsolant as $isolant) 
            {
                $listeReponse[] = array(
                    'id' => $isolant->getId(),
                    'isol_nom' => $isolant->getIsolNom(),
                    'isol_prix_unitaire' => $isolant->getIsolPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeIsolant" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
