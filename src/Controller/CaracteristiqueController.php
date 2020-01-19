<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Caracteristique;
use App\Entity\Client;

class CaracteristiqueController extends AbstractController
{
    /**
     * @Route("/caracteristique", name="caracteristique")
     */
    public function index()
    {
        return $this->render('caracteristique/index.html.twig', [
            'controller_name' => 'CaracteristiqueController',
        ]);
    }

            /**
    * Permet d'avoir la liste de tous les caracteristiques contenant le mot en parametre dans leur nom/prenom/mail 
    * @Route("/liste/module/{id}", name="caracteristique_liste_module", methods={"GET"});
    */
    public function listeCaracteristiqueModule($id) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class);
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $parametersAsArray = [];
        $resultat = "OK";
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('modu_id'); 
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);

        if ($resultat == "OK"){
            $listeReponse = $repository_caracteristique->rechercheCaracteristiqueModule($parametersAsArray['modu_id']);
            
            if ($listeReponse == null){
                $resultat = "Aucuns résultats."; 
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeCaracteristique" => $listeReponse,
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
