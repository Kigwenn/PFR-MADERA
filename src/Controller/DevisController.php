<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Composant;
use App\Entity\Adresse;
use App\Entity\Devis;
use App\Entity\Client;
use App\Entity\Module;
use App\Entity\Commercial;
use App\Entity\Caracteristique;
use App\Entity\ComposantModule;
use App\Entity\Maison;
use App\Entity\Gamme;
use App\Entity\Pays;
use App\Entity\Etat;
use App\Entity\Etape;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

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
        print_r(sizeof($parametersAsArray));
        print_r(sizeof($parametresObligatoire));
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
                'mais_id' => $devis->getMais()->getId(),
                'clie_id' => intval($client[0]['clie_id']), //getId() ne marche...
                'devi_nom' => $devis->getDeviNom(),
                'devi_date' => $devis->getDeviDate()->format("Y-m-d"),
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
        $parametresObligatoire[] = array('id', 'mais_id', 'gamm_id', 'comm_id', 'clie_id', 'devi_nom','devi_date', 'pays_id', 'adre_region', 'adre_ville', 'adre_cp', 'adre_rue', 'adre_complement', 'adre_info');
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
            $adresse = ($devis->getAdre());
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $devis->getId(),
                'etap_id' => $devis->getEtap()->getId(),
                'etat_id' => $devis->getEtat()->getId(),
                'gamm_id' => $devis->getGamm()->getId(),
                'comm_id' => $devis->getComm()->getId(),
                'mais_id' => $devis->getMais()->getId(),
                'clie_id' => $devis->getClie()->getId(),
                'devi_nom' => $devis->getDeviNom(),
                'devi_date' => $devis->getDeviDate()->format("Y-m-d"),
                'devi_prix' => $devis->getDeviPrix(),
                'adre_region' => $adresse->getAdreRegion(),
                'adre_ville' => $adresse->getAdreVille(),
                'adre_cp' => $adresse->getAdreCp(),
                'adre_rue' => $adresse->getAdreRue(),
                'adre_complement' => $adresse->getAdreComplement(),
                'adre_info' => $adresse->getAdreInfo(),
                'listClients' => '',
                'listMaisons' => '',
                'listGammes' => '',
                'listPays' => '',
                'pays_id' => '',
                'resultat' => '',
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
        $resultat = "OK";
        
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
        $devis = $repository_devis->find($id);
        $reponse = new Response (json_encode(array(
            'resultat' => "OK",
            'id' => $devis->getId(),
            )
        ));
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
    public function listeDevis(Request $request)
    {
        $resultat = "OK";

        $nb_pages = $request->query->get('page');
        $q = $request->query->get('q');
        $nb_pages = !empty($nb_pages) ? $nb_pages * 10 : $nb_pages = 10;
        $first  = $nb_pages - 10;
        $last  = $first + 9;

        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        //Recuperation de la liste de devis
        $listeDevis = (array) $repository_devis->findAll();
        $newListe = [];

        if ( !empty($q) ) {
            foreach ($listeDevis as $devis) {
                if ( strpos($devis->getId(), $q) !== false) {
                    $newListe[] = $devis;
                    continue;
                }
                if (strpos(strtolower ($devis->getDeviNom()),strtolower ($q)) !== false) {
                    $newListe[] = $devis;
                    continue;
                }
            }
        }
        else $newListe = $listeDevis;

        //Verification de la base
        if ($newListe == null) {
            $resultat = "Aucun devis trouvée.";
        }else{
            $listeReponse = [];
            foreach ($newListe as $key => $devis)
            {
                if( ($key >= $first) && ($key <= $last)) {

                    $listeReponse[] = array(
                        'id' => $devis->getId(),
                        'devi_nom' => $devis->getDeviNom(),
                        'devi_date' => $devis->getDeviDate(),
                        'devi_prix' => $devis->getDeviPrix()
                    );

                }
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
     * Permet d'avoir la liste de tous les devis
     * @Route("count", name="devis_count", methods={"GET"});
     */
    public function countDevis()
    {
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        //Recuperation de la liste de commercial
        $listeDevis = $repository_devis->findAll();
        $count = count($listeDevis);
        $reponse = new Response (json_encode(array(
            'resultat' => "OK",
            "count" => $count
        )));
        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access Control-Allow-Origin", "*");
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

    /**
    * 
    * @Route("/generationDossierEstimatif", name="devis_generation_dossier_estimatif", methods={"GET"});
    */
    public function generationDossierEstimatif($id) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $repository_module = $this->getDoctrine()->getRepository(Module::class); 
        $devis = $repository_devis->find($id);
        //Envoi de la réponse 
        if  ($devis == null) { 
            $reponse = new Response (json_encode(array(
                'resultat' => "Le devis n'existe pas.",
                )
            ));
            $reponse->headers->set("Content-Type", "application/json"); 
            $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
            return $reponse;
        }
        
        $adresse = $devis->getAdre();
        $infosDevis = array(
            'id' => $devis->getId(),
            'gamm_nom' => $devis->getGamm()->getGammNom(),
            'huis_prix' => $devis->getGamm()->getHuis()->getHuisPrixUnitaire(),
            'mais_nom' => $devis->getMais()->getMaisNom(),
            'mais_prix' => $devis->getMais()->getMaisPrix(),
            'mais_cdp' => $devis->getMais()->getMaisCdp(),
            'devi_nom' => $devis->getDeviNom(),
            'devi_date' => $devis->getDeviDate()->format("Y-m-d"),
            'devi_prix' => $devis->getDeviPrix(),
            'pays_nom' => $adresse->getPays()->getPaysNom(),
            'adre_region' => $adresse->getAdreRegion(),
            'adre_ville' => $adresse->getAdreVille(),
            'adre_cp' => $adresse->getAdreCp(),
            'adre_rue' => $adresse->getAdreRue(),
            'adre_complement' => $adresse->getAdreComplement(),
            'adre_info' => $adresse->getAdreInfo()
        );
    
        $listeClient = $repository_client->findAll();
        $idClient = $devis->getClie()->getId();
        foreach ($listeClient as $c) 
        {
            if ($c->getId() == $idClient){
                $client = $c;
                break;
            }  
        }

        $adresse = $client->getAdre(); 
        $infosClient = array(
            'pays_nom' => $adresse->getPays()->getPaysNom(),
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
        );

        $listeModules = [];
        $lesModules = $repository_module->rechercheModuleDevis($id);
        foreach ($lesModules as $m) 
        {
            $module = $repository_module->find($m['id']);    
            $listeModules[] = array(
                'id' => $module->getId(),
                'modu_nom' => $module->getModuNom(),
                'modu_prix_unitaire' => $module->getModuPrixUnitaire(),
                'modu_prix_total' => $module->getModuPrixTotal(),
                'cctp_nom' => $module->getCctp()->getCctpNom(),
                'tymo_nom' => $module->getTyMo()->getTymoNom()
            );   
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        // on inser les donné dans la deuxieme partie
        $html = $this->renderView('devis/DossierEstimatif.html.twig', [
            'infosDevis' => $infosDevis,
            'infosClient' => $infosClient,
            'listeModules' => $listeModules 
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }

    
    /**
    * 
    * @Route("/generationDossierTechnique", name="devis_generation_dossier_technique", methods={"GET"});
    */
    public function generationDossierTechnique($id) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_composant = $this->getDoctrine()->getRepository(Composant::class);
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class);
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class);
        $repository_composantmodule = $this->getDoctrine()->getRepository(ComposantModule::class);

        $devis = $repository_devis->find($id);
        //Envoi de la réponse 
        if  ($devis == null) { 
            $reponse = new Response (json_encode(array(
                'resultat' => "Le devis n'existe pas.",
                )
            ));
            $reponse->headers->set("Content-Type", "application/json"); 
            $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
            return $reponse;
        }

        $adresse = $devis->getAdre();
        $infosDevis = array(
            'id' => $devis->getId(),
            'gamm_nom' => $devis->getGamm()->getGammNom(),
            'huis_prix' => $devis->getGamm()->getHuis()->getHuisPrixUnitaire(),
            'mais_nom' => $devis->getMais()->getMaisNom(),
            'mais_prix' => $devis->getMais()->getMaisPrix(),
            'mais_cdp' => $devis->getMais()->getMaisCdp(),
            'devi_nom' => $devis->getDeviNom(),
            'devi_date' => $devis->getDeviDate()->format("Y-m-d"),
            'devi_prix' => $devis->getDeviPrix(),
            'pays_nom' => $adresse->getPays()->getPaysNom(),
            'adre_region' => $adresse->getAdreRegion(),
            'adre_ville' => $adresse->getAdreVille(),
            'adre_cp' => $adresse->getAdreCp(),
            'adre_rue' => $adresse->getAdreRue(),
            'adre_complement' => $adresse->getAdreComplement(),
            'adre_info' => $adresse->getAdreInfo()
        );
    
        $listeClient = $repository_client->findAll();
        $idClient = $devis->getClie()->getId();
        foreach ($listeClient as $c) 
        {
            if ($c->getId() == $idClient){
                $client = $c;
                break;
            }  
        }

        $adresse = $client->getAdre(); 
        $infosClient = array(
            'pays_nom' => $adresse->getPays()->getPaysNom(),
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
        );

        $lesModules = $repository_module->rechercheModuleDevis($id);
        $listeModules = [];

        foreach ($lesModules as $m) 
        {
            $module = $repository_module->find($m['id']); 
            $listeCaracteristiques = $repository_caracteristique->rechercheCaracteristiqueModule($module->getId());
            $lesComposantModules = $repository_composantmodule->rechercheComposants($module->getId());
            $listeComposants = [];
            
            foreach ($lesComposantModules as $cm) 
            {
                $modulecomposant = $repository_composantmodule->find($cm['id']);
                $composant = $modulecomposant->getComp(); 
                $listeComposants[] = array(
                    'id' => $composant->getId(),
                    'comp_nom' => $composant->getCompNom(),
                    'comp_type' => $composant->getCompNom(),
                    'comp_prix_unitaire' => $composant->getCompPrixUnitaire(),
                    'quantite' => $modulecomposant->getComoQuantite(),
                ); 
            }
             
            $listeModules[] = array(
                'id' => $module->getId(),
                'modu_nom' => $module->getModuNom(),
                'modu_prix_unitaire' => $module->getModuPrixUnitaire(),
                'modu_prix_total' => $module->getModuPrixTotal(),
                'cctp_nom' => $module->getCctp()->getCctpNom(),
                'tymo_nom' => $module->getTyMo()->getTymoNom(),
                'listeCaracteristiques' => $listeCaracteristiques,
                'listeComposants' => $listeComposants,
            );   
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        // on inser les donné dans la deuxieme partie
        $html = $this->renderView('devis/DossierTechnique.html.twig', [
            'infosDevis' => $infosDevis,
            'infosClient' => $infosClient,
            'listeModules' => $listeModules 
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
        
    }
}
