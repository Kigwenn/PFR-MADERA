<?php

namespace App\Controller;
use App\Entity\Huisseries;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HuisseriesController extends AbstractController
{
    /**
     * @Route("/huisseries", name="huisseries")
     */
    public function index()
    {
        return $this->render('huisseries/index.html.twig', [
            'controller_name' => 'HuisseriesController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="huisseries_liste", methods={"GET"});
    */
    public function listeHuisseries(Request $requestjson) 
    {
        $repository_huisseries = $this->getDoctrine()->getRepository(Huisseries::class);
        //Recuperation de la liste de huisseries
        $listeHuisseries = $repository_huisseries->findAll();
        // on vérifie si il y a bien une liste de huisseries
        if ($listeHuisseries == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune huisserie trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeHuisseries as $huisseries) 
            {
                $listeReponse[] = array(
                    'id' => $huisseries->getId(),
                    'huis_nom' => $huisseries->getHuisNom(),
                    'huis_prix_unitaire' => $huisseries->getHuisPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeHuisseries" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
