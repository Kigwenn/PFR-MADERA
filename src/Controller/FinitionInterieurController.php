<?php

namespace App\Controller;
use App\Entity\FinitionInterieur;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FinitionInterieurController extends AbstractController
{
    /**
     * @Route("/finition/interieur", name="finition_interieur")
     */
    public function index()
    {
        return $this->render('finition_interieur/index.html.twig', [
            'controller_name' => 'FinitionInterieurController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les finitions
    * @Route("/liste", name="finitionInterieur_liste", methods={"GET"});
    */
    public function listeFinitionInterieur(Request $requestjson) 
    {
        $repository_finitionInterieur = $this->getDoctrine()->getRepository(FinitionInterieur::class);
        //Recuperation de la liste de finitionInterieur
        $listeFinitionInterieur = $repository_finitionInterieur->findAll();
        // on vérifie si il y a bien une liste de finitionInterieur
        if ($listeFinitionInterieur == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeFinitionInterieur as $finitionInterieur) 
            {
                $listeReponse[] = array(
                    'id' => $finitionInterieur->getId(),
                    'fiin_nom' => $finitionInterieur->getFiinNom(),
                    'fiin_prix_unitaire' => $finitionInterieur->getFiinPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeFinitionInterieur" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
