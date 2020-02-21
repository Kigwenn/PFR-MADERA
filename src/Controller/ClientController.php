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
//    /**
//     * @Route("/", name="client")
//     *
//     */
//    public function index()
//    {
//        return $this->render('client/index.html.twig', [
//            'controller_name' => 'ClientController',
//        ]);
//    }


    /** 
    * Permet de créer un client et son adresse 
    * @Route("", name="client_creation", methods={"POST"}) 
    */
    public function creationClient(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $parametersAsArray = [];
        $resultat = "OK";

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('pers_sexe', 'pers_nom', 'pers_prenom', 'pers_mail','pers_tel',
            'pays_id', 'adre_rue', 'adre_ville', 'adre_cp', 'adre_region', 'adre_complement', 'adre_info');
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du pays et du client
        if ($resultat == "OK")
        {
            $repository_pays = $this->getDoctrine()->getRepository(Pays::class); 
            $pays = $repository_pays->find($parametersAsArray['pays_id']); 
            if ($pays == null) {
                $resultat =  "Pays introuvable.";
            }else{
                if (count($repository_client->clientExistant($parametersAsArray['pers_nom'],
                $parametersAsArray['pers_prenom'], $parametersAsArray['pers_mail'])) > 0){
                    $resultat =  "Client déjà existant.";
                }
            }
        }

        //Creation du client
        if  ($resultat == "OK") {
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
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $client->getId()
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

     /**
    * Permet d'avoir le detail d'un clients 
    * @Route("{id}", name="client_affichage", methods={"GET"});
    */
    public function affichageClient($id)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $repository_personne = $this->getDoctrine()->getRepository(Personne::class);
        $parametersAsArray = [];
        $resultat = "OK";

        //On verifie si le client existe bien
        if ($resultat == "OK"){
            $listeClient = $repository_client->findAll();
            $client = null;
            foreach ($listeClient as $c) 
            {
                if ($c->getId() == $id){
                    $client = $c;
                    break;
                }  
            }
            if ($client == null){
                $resultat = "Le client n'existe pas.";
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class);  
            $adresse = $client->getAdre();
            $reponse = new Response(json_encode(array(
                'resultat' => "OK",
                'pays_id' => $adresse->getPays()->getId(),
                'adre_region' => $adresse->getAdreRegion(),
                'adre_ville' => $adresse->getAdreVille(),
                'adre_cp' => $adresse->getAdreCp(),
                'adre_rue' => $adresse->getAdreRue(),
                'adre_complement' => $adresse->getAdreComplement(),
                'adre_info' => $adresse->getAdreInfo(),
                'id' => $client->getId(),
                'pers_sexe' => $client->getPersSexe(),
                'pers_nom' => $client->getPersNom(),
                'pers_prenom' => $client->getPersPrenom(),
                'pers_mail' => $client->getPersMail(),
                'pers_tel' => $client->getPersTel()
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $resultat,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /** 
    * Permet de modifier un client et son adresse 
    * @Route("", name="client_modification", methods={"PUT"}) 
    */
    public function modificationClient(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $parametersAsArray = [];
        $resultat = "OK";

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('id', 'pers_nom', 'pers_prenom', 'adre_rue', 'adre_complement', 'adre_info', 'adre_ville', 'adre_cp', 'adre_region', 'pers_mail', 'pers_tel', 'pers_sexe', 'pays_id' );
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du pays et du client
        if ($resultat == "OK")
        {
            $listeClient = $repository_client->findAll();
            $client = null;
            foreach ($listeClient as $c) 
            {
                if ($c->getId() == $parametersAsArray['id']){
                    $client = $c;
                    break;
                }  
            }
            if ($client == null){
                $resultat = "Le client n'existe pas.";
            }else {
                $repository_pays = $this->getDoctrine()->getRepository(Pays::class); 
                $pays = $repository_pays->find($parametersAsArray['pays_id']); 
                if ($pays == null) {
                    $resultat =  "Pays introuvable.";
                }           
            }
        }

        //Modification du client
        if  ($resultat == "OK") {
            $adresse = $client->getAdre();
            $adresse->setPays($pays);
            $adresse->setAdreRegion($parametersAsArray['adre_region']);
            $adresse->setAdreVille($parametersAsArray['adre_ville']);
            $adresse->setAdreCp($parametersAsArray['adre_cp']);
            $adresse->setAdreRue($parametersAsArray['adre_rue']);
            $adresse->setAdreComplement($parametersAsArray['adre_complement']);
            $adresse->setAdreInfo($parametersAsArray['adre_info']);
            $entityManager->persist($adresse);
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
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $client->getId()
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /** 
    * Permet de supprimer un client et son adresse grâce à l'id de l'client
    * @Route("", name="client_suppression", methods={"DELETE"}),
    */
    public function suppressionClient($id){
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class); 
        $listeClient = $repository_client->findAll();
        $client = null;
        foreach ($listeClient as $c) 
        {
            if ($c->getId() == $id){
                $client = $c;
                break;
            }  
        }

        if ($client == null){
            $reponse = new Response (json_encode(array(
                'resultat' =>  "Le client " . $id . " n'existe pas.",
                )
            ));
        } else {
            //Suppression
            $entityManager->remove($client);
            $entityManager->flush();  
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $id,
                )
            ));
        }

        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;        
    }



    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="client_liste", methods={"GET"});
    */
    public function listeClient(Request $requestjson) 
    {
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        //Recuperation de la liste de client
        $listeClient = $repository_client->findAll();
        // on vérifie si il y a bien une liste de client
        if ($listeClient == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucun client trouvé.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeClient as $client) 
            {
                $listeReponse[] = array(
                    'id' => $client->getId(),
                    'pers_nom' => $client->getPersNom(),
                    'pers_prenom' => $client->getPersPrenom(),
                    'pers_mail' => $client->getPersMail(),
                );
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeClients" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /**
     * Permet d'avoir le nombre de client
     * @Route("count", name="client_count", methods={"GET"});
     */
    public function countClient(Request $request)
    {
        $request->query->get('q');
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        //Recuperation de la liste de commercial
        $listeClient = $repository_client->findAll();
        $count = count($listeClient);
        $reponse = new Response (json_encode(array(
            'resultat' => "OK",
            "count" => $count
        )));
        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access Control-Allow-Origin", "*");
        return $reponse;
    }

    /**
    * Permet d'avoir la liste de tous les clients contenant le mot en parametre dans leur nom/prenom/mail 
    * @Route("/recherche", name="client_recherche", methods={"GET"});
    */
    public function rechercheClient($recherche) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);

        $listeReponse = $repository_client->rechercheClients($recherche);
        if ($listeReponse == null){
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucuns résultats.",
                )
            ));
        } else { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeClient" => $listeReponse,
                )
            ));
        } 
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }


}
