<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\CCTP;

class CCTPController extends AbstractController
{
    /**
     * @Route("/c/c/t/p", name="c_c_t_p")
     */
    public function index()
    {
        return $this->render('cctp/index.html.twig', [
            'controller_name' => 'CCTPController',
        ]);
    }

        /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="CCTP_liste", methods={"GET"});
    */
    public function listeCCTP(Request $requestjson) 
    {
        $repository_CCTP = $this->getDoctrine()->getRepository(CCTP::class);
        //Recuperation de la liste de CCTP
        $listeCCTP = $repository_CCTP->findAll();
        // on vérifie si il y a bien une liste de CCTP
        if ($listeCCTP == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucun CCTP trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeCCTP as $CCTP) 
            {
                $listeReponse[] = array(
                    'id' => $CCTP->getId(),
                    'cctp_nom' => $CCTP->getCctpNom(),
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeCctp" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }      
}
