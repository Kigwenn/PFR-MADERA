<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etape;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/etape")
 */
class EtapeController extends AbstractController
{
    /**
     * Permet d'avoir la liste des etapes
     * @Route("/liste", name="etape_liste", methods={"GET"});
     * @return Response
     */
    public function listeEtape()
    {
        $repository_etape = $this->getDoctrine()->getRepository(Etape::class);
        //Recuperation de la liste d'etape
        $listeEtape = $repository_etape->findAll();
        // on vérifie si il y a bien une liste d'etape'
        if ($listeEtape == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune etape trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeEtape as $etape)
            {
                $listeReponse[] = array(
                    'id' => $etape->getId(),
                    'etap_nom' => $etape->getEtapNom()
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeEtape" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
