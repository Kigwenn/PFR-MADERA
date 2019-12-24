<?php

namespace App\Controller;
use App\Entity\Couverture;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CouvertureController extends AbstractController
{
    /**
     * @Route("/couverture", name="couverture")
     */
    public function index()
    {
        return $this->render('couverture/index.html.twig', [
            'controller_name' => 'CouvertureController',
        ]);
    }


    /**
    * Permet d'avoir la liste des couvertures
    * @Route("/liste", name="couverture_liste", methods={"GET"});
    */
    public function listeCouverture(Request $requestjson) 
    {
        $repository_couverture = $this->getDoctrine()->getRepository(Couverture::class);
        //Recuperation de la liste de couverture
        $listeCouverture = $repository_couverture->findAll();
        // on vérifie si il y a bien une liste de couverture
        if ($listeCouverture == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeCouverture as $couverture) 
            {
                $listeReponse[] = array(
                    'id' => $couverture->getId(),
                    'couv_nom' => $couverture->getCouvNom(),
                    'couv_prix_unitaire' => $couverture->getCouvPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeCouverture" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
