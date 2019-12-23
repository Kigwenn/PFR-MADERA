<?php

namespace App\Controller;
use App\Entity\FinitionExterieur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FinitionExterieurController extends AbstractController
{
    /**
     * @Route("/finition/exterieur", name="finition_exterieur")
     */
    public function index()
    {
        return $this->render('finition_exterieur/index.html.twig', [
            'controller_name' => 'FinitionExterieurController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="finitionExterieur_liste", methods={"GET"});
    */
    public function listeFinitionExterieur(Request $requestjson) 
    {
        $repository_finitionExterieur = $this->getDoctrine()->getRepository(FinitionExterieur::class);
        //Recuperation de la liste de finitionExterieur
        $listeFinitionExterieur = $repository_finitionExterieur->findAll();
        // on vérifie si il y a bien une liste de finitionExterieur
        if ($listeFinitionExterieur == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeFinitionExterieur as $finitionExterieur) 
            {
                $listeReponse[] = array(
                    'id' => $finitionExterieur->getId(),
                    'fiex_nom' => $finitionExterieur->getFiexNom(),
                    'fiex_prix_unitaire' => $finitionExterieur->getFiexPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeFinitionExterieur" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
