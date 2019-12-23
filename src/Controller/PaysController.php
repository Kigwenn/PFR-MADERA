<?php

namespace App\Controller;
use App\Entity\Pays;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="pays")
     */
    public function index()
    {
        return $this->render('pays/index.html.twig', [
            'controller_name' => 'PaysController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="pays_liste", methods={"GET"});
    */
    public function listePays(Request $requestjson) 
    {
        $repository_pays = $this->getDoctrine()->getRepository(Pays::class);
        //Recuperation de la liste de pays
        $listePays = $repository_pays->findAll();
        // on vérifie si il y a bien une liste de pays
        if ($listePays == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucun pays trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listePays as $pays) 
            {
                $listeReponse[] = array(
                    'id' => $pays->getId(),
                    'pays_nom' => $pays->getPaysNom(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listePays" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }   
}
