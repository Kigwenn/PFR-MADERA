<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Maison;

class MaisonController extends AbstractController
{
    /**
     * @Route("/maison", name="maison")
     */
    public function index()
    {
        return $this->render('maison/index.html.twig', [
            'controller_name' => 'MaisonController',
        ]);
    }

        /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="maison_liste", methods={"GET"});
    */
    public function listeMaison(Request $requestjson) 
    {
        $repository_maison = $this->getDoctrine()->getRepository(Maison::class);
        //Recuperation de la liste de maison
        $listeMaison = $repository_maison->findAll();
        // on vérifie si il y a bien une liste de maison
        if ($listeMaison == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucune finition trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeMaison as $maison) 
            {
                $listeReponse[] = array(
                    'id' => $maison->getId(),
                    'mais_nom' => $maison->getMaisNom()
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeMaison" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    } 
}
