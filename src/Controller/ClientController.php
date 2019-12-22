<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\Client;
use App\Entity\Adresse;
use App\Entity\Pays;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client")
     * 
     */
    public function index()
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    /** 
    * Permet de créer un client et son adresse 
    * @Route("", name="client_creation", methods={"POST"}) 
    */
    public function creationClient(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $parametersAsArray = [];
        $erreur = null;

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('pers_sexe', 'pers_nom', 'pers_prenom', 'pers_mail','pers_tel',
            'pays_id', 'adre_rue', 'adre_ville', 'adre_cp', 'adre_region', 'adre_complement', 'adre_info');
        if ($parametersAsArray == null){
            $erreur = "Il n'y a pas de paramètre.";
        } elseif (count($parametersAsArray) <> 12)
        {
            $erreur = "Il n'y a pas le bon nombre de paramètre.";
        } else {
            foreach ($parametersAsArray as $key => $value){
                if (!in_array($key, $parametresObligatoire[0])) 
                {
                    $erreur = "Le paramètre " . strval($key) . " n'existe pas.";
                    break;
                }
            }

            // Vérification du pays et du client
            if ($erreur == null)
            {
                $repository_pays = $this->getDoctrine()->getRepository(Pays::class); 
                $pays = $repository_pays->find($parametersAsArray['pays_id']); 
                if ($pays == null) {
                    $erreur =  "Pays introuvable.";
                }else{
                    if (count($repository_client->clientExistant($parametersAsArray['pers_nom'],
                    $parametersAsArray['pers_prenom'], $parametersAsArray['pers_mail'])) > 0){
                        $erreur =  "Client déjà existant.";
                    }
                }
            }
        }

        //Creation du client
        if  ($erreur == null) {
            //Creation de l'adresse
            $adresse = new Adresse();
            $adresse->setPays($pays);
            $adresse->setAdreRegion($parametersAsArray['adre_region']);
            $adresse->setAdreVille($parametersAsArray['adre_ville']);
            $adresse->setAdreCp($parametersAsArray['adre_cp']);
            $adresse->setAdreRue($parametersAsArray['adre_rue']);
            $adresse->setAdreComplement($parametersAsArray['adre_complement']);
            $adresse->setAdreInfo($parametersAsArray['adre_info']);
            $entityManager->persist($adresse);
            //Creation du client
            $client = new Client();
            $client->setPersSexe($parametersAsArray['pers_sexe']);
            $client->setPersNom($parametersAsArray['pers_nom']);
            $client->setPersPrenom($parametersAsArray['pers_prenom']);
            $client->setPersMail($parametersAsArray['pers_mail']);
            $client->setPersTel($parametersAsArray['pers_tel']);
            $client->setAdre($adresse); 
            $entityManager->persist($client); 
            $entityManager->flush();
        }

        //Envoi de la réponse 
        if  ($erreur == null) { 
            $id = $repository_client->clientExistant($parametersAsArray['pers_nom'],
                $parametersAsArray['pers_prenom'], $parametersAsArray['pers_mail']);
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $id[0], //$client->getId() renvoie null
                'nom_client' => $client->getPersNom(), 
                'prenom_client' => $client->getPersPrenom()
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $erreur
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }
}
