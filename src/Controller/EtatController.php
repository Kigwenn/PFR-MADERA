<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etat;
use Symfony\Component\HttpFoundation\Response;
/**
 * @Route("/etat")
 */
class EtatController extends AbstractController
{
    /**
    * Permet d'avoir la liste des etats
    * @Route("/liste", name="etat_liste", methods={"GET"});
    */
    public function listeEtat()
    {
        $repository_etat = $this->getDoctrine()->getRepository(Etat::class);
        //Recuperation de la liste d'etape
        $listeEtat = $repository_etat->findAll();
        // on vérifie si il y a bien une liste d'etat'
        if ($listeEtat == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune etape trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeEtat as $etat)
            {
                $listeReponse[] = array(
                    'id' => $etat->getId(),
                    'etat_nom' => $etat->getEtatNom()
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeEtat" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
