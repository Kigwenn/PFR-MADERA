<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adresse;
use App\Entity\Devis;
use App\Entity\Client;
use App\Entity\Commercial;
use App\Entity\Maison;
use App\Entity\Gamme;
use App\Entity\Pays;
use App\Entity\Etat;
use App\Entity\Etape;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/devis")
 */
class DevisController extends AbstractController
{

    /** 
    * Permet de créer un devis et son adresse 
    * @Route("", name="devis_creation", methods={"POST"}) 
    */
    public function creationDevis(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $parametersAsArray = [];
        $resultat = null;

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('mais_id', 'gamm_id', 'comm_id', 'clie_id', 'devi_nom','devi_date', 'pays_id',
            'adre_region', 'adre_ville', 'adre_cp', 'adre_rue', 'adre_complement', 'adre_info'); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Verification du Client
        if ($resultat == "OK") {  
            $listeClient = $repository_client->findAll();
            $client = null;
            foreach ($listeClient as $c) 
            {
                if ($c->getId() == $parametersAsArray['clie_id']){
                    $client = $c;
                    break;
                }  
            }
            if ($client == null){
                $resultat = "Le client n'existe pas.";
            }
        }
        // Verification Commercial   
        if ($resultat == "OK") {  
            $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
            $listeCommercial = $repository_commercial->findAll();
            $commercial = null;
            foreach ($listeCommercial as $c) 
            {
                if ($c->getId() == $parametersAsArray['comm_id']){
                    $commercial = $c;
                    break;
                }  
            }
            if ($commercial == null){
                $resultat = "Le commercial n'existe pas.";
            }
        }       
        // Verification Maison
        if ($resultat == "OK") {
            $repository_maison = $this->getDoctrine()->getRepository(Maison::class); 
            $maison = $repository_maison->find($parametersAsArray['mais_id']); 
            if ($maison == null) {
                $resultat =  "Le maison n'existe pas.";
            }    
        }
        // Verfication Gamme
        if ($resultat == "OK") {
            $repository_gamme = $this->getDoctrine()->getRepository(Gamme::class); 
            $gamme = $repository_gamme->find($parametersAsArray['gamm_id']); 
            if ($gamme == null) {
                $resultat =  "Le gamme n'existe pas.";
            }    
        }
        // verification Pays
        if ($resultat == "OK") {
            $repository_pays = $this->getDoctrine()->getRepository(Pays::class); 
            $pays = $repository_pays->find($parametersAsArray['pays_id']); 
            if ($pays == null) {
                $resultat =  "Le pays n'existe pas.";
            }    
        }
        //Creation du devis
		if ($resultat == "OK") {
            $repository_etat = $this->getDoctrine()->getRepository(Etat::class);
            $repository_etape = $this->getDoctrine()->getRepository(Etape::class);

            $adresse = new Adresse();
            $adresse->setPays($pays);
            $adresse->setAdreRegion($parametersAsArray['adre_region']);
            $adresse->setAdreVille($parametersAsArray['adre_ville']);
            $adresse->setAdreCp($parametersAsArray['adre_cp']);
            $adresse->setAdreRue($parametersAsArray['adre_rue']);
            $adresse->setAdreComplement($parametersAsArray['adre_complement']);
            $adresse->setAdreInfo($parametersAsArray['adre_info']);
            $entityManager->persist($adresse); 
            $devis = new Devis(); 
            $devis->setDeviNom($parametersAsArray['devi_nom']);
            $devis->setDeviDate(new \DateTime('@'.strtotime('now')));
            $devis->setDeviPrix(0);
            $devis->setEtat($repository_etat->find(1));
            $devis->setEtap($repository_etape->find(1));
            $devis->setGamm($gamme);
            $devis->setComm($commercial);
            $devis->setClie($client);
            $devis->setAdre($adresse);
            $devis->setMais($maison);
            $entityManager->persist($devis); 
            $entityManager->flush();
        }
		
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $devis->getId(), 
                'nom_devis' => $devis->getDeviNom(),
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /**
    * Permet d'avoir le detail d'un deviss 
    * @Route("", name="devis_affichage", methods={"GET"});
    */
    public function affichageDevis($id)
    {
        $parametersAsArray = [];
        $resultat = "OK";
        $repository_client = $this->getDoctrine()->getRepository(Client::class);

        //On verifie si l'devis existe bien
        if ($resultat == "OK"){
            $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
            $devis = $repository_devis->find($id);
            if ($devis == null){
                $resultat = "Le devis n'existe pas.";
            }
        }
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $adresse = $devis->getAdre();
            $client = $repository_devis->rechercheClient($devis->getId());
            $reponse = new Response(json_encode(array(
                'result' => "OK",
                'id' => $devis->getId(),
                'etap_id' => $devis->getEtap()->getId(),
                'etat_id' => $devis->getEtat()->getId(),
                'gamm_id' => $devis->getGamm()->getId(),
                'comm_id' => $devis->getComm()->getId(),
                'clie_id' => intval($client[0]['clie_id']), //getId() ne marche...
                'devi_nom' => $devis->getDeviNom(),
                'devi_date' => $devis->getDeviDate(),
                'devi_prix' => $devis->getDeviPrix(),
                'adre_id' => $adresse->getId(),
                'pays_id' => $adresse->getPays()->getId(),
                'adre_region' => $adresse->getAdreRegion(),
                'adre_ville' => $adresse->getAdreVille(),
                'adre_cp' => $adresse->getAdreCp(),
                'adre_rue' => $adresse->getAdreRue(),
                'adre_complement' => $adresse->getAdreComplement(),
                'adre_info' => $adresse->getAdreInfo()
                ))
            );
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
    * Permet de modifier un devis
    * @Route("/", methods={"PUT"}) 
    */
    public function modificationDevis(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $parametersAsArray = [];
        $resultat = null;

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('id', 'mais_id', 'gamm_id', 'comm_id', 'clie_id', 'devi_nom','devi_date', 'pays_id',
            'adre_region', 'adre_ville', 'adre_cp', 'adre_rue', 'adre_complement', 'adre_info'); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Verification du Devis
        if ($resultat == "OK") {
            $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
            $devis = $repository_devis->find($parametersAsArray['id']); 
            if ($devis == null) {
                $resultat =  "Le devis n'existe pas.";
            }    
        }
        // Verification du Client
        if ($resultat == "OK") {  
            $listeClient = $repository_client->findAll();
            $client = null;
            foreach ($listeClient as $c) 
            {
                if ($c->getId() == $parametersAsArray['clie_id']){
                    $client = $c;
                    break;
                }  
            }
            if ($client == null){
                $resultat = "Le client n'existe pas.";
            }
        }
        // Verification Commercial   
        if ($resultat == "OK") {  
            $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
            $listeCommercial = $repository_commercial->findAll();
            $commercial = null;
            foreach ($listeCommercial as $c) 
            {
                if ($c->getId() == $parametersAsArray['comm_id']){
                    $commercial = $c;
                    break;
                }  
            }
            if ($commercial == null){
                $resultat = "Le commercial n'existe pas.";
            }
        }       
        // Verification Maison
        if ($resultat == "OK") {
            $repository_maison = $this->getDoctrine()->getRepository(Maison::class); 
            $maison = $repository_maison->find($parametersAsArray['mais_id']); 
            if ($maison == null) {
                $resultat =  "Le maison n'existe pas.";
            }    
        }
        // Verfication Gamme
        if ($resultat == "OK") {
            $repository_gamme = $this->getDoctrine()->getRepository(Gamme::class); 
            $gamme = $repository_gamme->find($parametersAsArray['gamm_id']); 
            if ($gamme == null) {
                $resultat =  "Le gamme n'existe pas.";
            }    
        }
        // verification Pays
        if ($resultat == "OK") {
            $repository_pays = $this->getDoctrine()->getRepository(Pays::class); 
            $pays = $repository_pays->find($parametersAsArray['pays_id']); 
            if ($pays == null) {
                $resultat =  "Le pays n'existe pas.";
            }    
        }
        //Creation du devis
		if ($resultat == "OK") {
            $repository_etat = $this->getDoctrine()->getRepository(Etat::class);
            $repository_etape = $this->getDoctrine()->getRepository(Etape::class);

            $adresse = $devis->getAdre();
            $adresse->setPays($pays);
            $adresse->setAdreRegion($parametersAsArray['adre_region']);
            $adresse->setAdreVille($parametersAsArray['adre_ville']);
            $adresse->setAdreCp($parametersAsArray['adre_cp']);
            $adresse->setAdreRue($parametersAsArray['adre_rue']);
            $adresse->setAdreComplement($parametersAsArray['adre_complement']);
            $adresse->setAdreInfo($parametersAsArray['adre_info']);
            $entityManager->persist($adresse); 

            $devis->setDeviNom($parametersAsArray['devi_nom']);
            // $devis->setDeviDate(new \DateTime('@'.strtotime('now')));
            // $devis->setDeviPrix(0);
            // $devis->setEtat($repository_etat->find(1));
            // $devis->setEtap($repository_etape->find(1));
            $devis->setGamm($gamme);
            $devis->setComm($commercial);
            $devis->setClie($client);
            $devis->setAdre($adresse);
            $devis->setMais($maison);
            $entityManager->persist($devis); 
            $entityManager->flush();
        }
		
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $devis->getId(), 
                'nom_devis' => $devis->getDeviNom(),
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;  
    }
        
    /** 
    * Permet de supprimer un devis
    * @Route("", name="devis_suppression", methods={"DELETE"}),
    */
    public function suppressionDevis($id){
        $repository_client = $this->getDoctrine()->getRepository(Client::class); 
        $resultat = "OK";
        
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
        $devis = $repository_devis->find($id);
        if ($devis == null) {
            $resultat = "Le devis n'existe pas.";
            $reponse = new Response (json_encode(array(
                'resultat' => "Le devis n'existe pas.",
                'id' => $id,
                )
            ));
        } else {
            $entityManager->remove($devis);
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
    * Permet d'avoir la liste de tous les devis 
    * @Route("", name="devis_liste", methods={"GET"});
    */
    public function listeDevis(Request $requestjson) 
    {
        $resultat = "OK";
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        //Recuperation de la liste de devis
        $listeDevis = $repository_devis->findAll();
        //Verification de la base
        if ($listeDevis == null) {
            $resultat = "Aucun devis trouvée.";
        }else{
            $listeReponse = array();
            foreach ($listeDevis as $devis) 
            {
                $listeReponse[] = array(
                    'id' => $devis->getId(),
                    'devi_nom' => $devis->getDeviNom(),
                    'devi_date' => $devis->getDeviDate(),
                    'devi_prix' => $devis->getDeviPrix()  
                );  
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeDevis" => $listeReponse,
                )
            ));
        }else{
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /**
    * Permet d'avoir la liste de tous les devis du client
    * @Route("/listeDuClient", name="devis_listeDuClient", methods={"GET"});
    */
    public function listeDuClient(Request $requestjson) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $parametersAsArray = [];
        $resultat = "OK";
        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('clie_id');
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);

        if ($resultat == "OK"){
            $listeReponse = $repository_devis->rechercheDevisClient($parametersAsArray['clie_id']);

            if ($listeReponse == null){
                $resultat = "Aucuns résultats.";
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeDevis" => $listeReponse,
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
