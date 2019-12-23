<?php

namespace App\Controller;
use App\Entity\Remplissage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RemplissageController extends AbstractController
{
    /**
     * @Route("/remplissage", name="remplissage")
     */
    public function index()
    {
        return $this->render('remplissage/index.html.twig', [
            'controller_name' => 'RemplissageController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les remplissage
    * @Route("/liste", name="remplissage_liste", methods={"GET"});
    */
    public function listeRemplissage(Request $requestjson) 
    {
        $repository_remplissage = $this->getDoctrine()->getRepository(Remplissage::class);
        //Recuperation de la liste de remplissage
        $listeRemplissage = $repository_remplissage->findAll();
        // on vérifie si il y a bien une liste de remplissage
        if ($listeRemplissage == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeRemplissage as $remplissage) 
            {
                $listeReponse[] = array(
                    'id' => $remplissage->getId(),
                    'remp_nom' => $remplissage->getRempNom(),
                    'remp_prix_unitaire' => $remplissage->getRempPrixUnitaire(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeRemplissage" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
