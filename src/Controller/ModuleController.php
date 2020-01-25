<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adresse;
use App\Entity\Module;
use App\Entity\Devis;
use App\Entity\Client;
use App\Entity\Maison;
use App\Entity\Gamme;
use App\Entity\CCTP;
use App\Entity\Couverture;
use App\Entity\Isolant;
use App\Entity\FinitionExterieur;
use App\Entity\FinitionInterieur;
use App\Entity\TypeModule;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/module")
 */
class ModuleController extends AbstractController
{

    /** 
    * Permet de créer un module et son adresse 
    * @Route("", name="module_creation", methods={"POST"}) 
    */
    public function creationModule(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        $parametersAsArray = [];
        $resultat = null;

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('tymo_id', 'devi_id', 'cctp_id', 'fiex_id', 'fiin_id', 'couv_id', 'modu_nom', 'modu_prix_unitaire', 'isol_id'); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
     
        // verification du devis
        if (($resultat == "OK") && ($parametersAsArray['devi_id'] <> null)) {
            $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
            $devis = $repository_devis->find($parametersAsArray['devi_id']); 
            if ($devis == null) {
                $resultat =  "Le devis n'existe pas.";
            }    
        }

        // verification du type de module
        if (($resultat == "OK") && ($parametersAsArray['tymo_id'] <> null)) {
            $repository_typeModule = $this->getDoctrine()->getRepository(TypeModule::class); 
            $typeModule = $repository_typeModule->find($parametersAsArray['devi_id']); 
            if ($typeModule == null) {
                $resultat =  "Le type module n'existe pas.";
            }    
        }
     
        // verification du cctp
        if ($resultat == "OK") {
            $repository_cctp = $this->getDoctrine()->getRepository(CCTP::class); 
            $cctp = $repository_cctp->find($parametersAsArray['cctp_id']); 
            if ($cctp == null) {
                $resultat =  "Le cctp n'existe pas.";
            }    
        }

        // verification de la finition_exterieur
        if ($resultat == "OK") {
            $repository_finition_exterieur = $this->getDoctrine()->getRepository(FinitionExterieur::class); 
            $finition_exterieur = $repository_finition_exterieur->find($parametersAsArray['fiex_id']); 
            if (($finition_exterieur == null) && ($parametersAsArray['fiex_id'] <> null)) {
                $resultat =  "La finition exterieur n'existe pas.";
            }    
        }

        // verification de la finition_interieur
        if ($resultat == "OK") {
            $repository_finition_interieur = $this->getDoctrine()->getRepository(FinitionInterieur::class); 
            $finition_interieur = $repository_finition_interieur->find($parametersAsArray['fiin_id']); 
            if (($finition_interieur == null) && ($parametersAsArray['fiin_id'] <> null)) {
                $resultat =  "La finition interieur n'existe pas.";
            }    
        }

        // verification de la couverture
        if ($resultat == "OK") {
            $repository_couverture = $this->getDoctrine()->getRepository(Couverture::class); 
            $couverture = $repository_couverture->find($parametersAsArray['couv_id']); 
            if (($couverture == null) && ($parametersAsArray['couv_id'] <> null)) {
                $resultat =  "La couverture n'existe pas.";
            }    
        }

        // verification de l'isolant
        if ($resultat == "OK") {
            $repository_isolant = $this->getDoctrine()->getRepository(Isolant::class); 
            $isolant = $repository_isolant->find($parametersAsArray['isol_id']); 
            if (($isolant == null) && ($parametersAsArray['isol_id'] <> null)) {
                $resultat =  "L'isolant n'existe pas.";
            }    
        }

        //Creation du module
		if ($resultat == "OK") {
            $module = new Module();
            $module->setModuNom($parametersAsArray['modu_nom']);
            $module->setModuTymo($typeModule);
            //$module->setModuPrixUnitaire();
            $module->setCCTP($cctp);
            $module->setFiex($finition_exterieur);
            $module->setFiin($finition_interieur);
            $module->setCouv($couverture);
            $module->setIsol($isolant);
            $entityManager->persist($module); 
            $entityManager->flush();
        }
		
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $module->getId(), 
                'modu_nom' => $module->getModuNom(),
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
    * Permet d'avoir le detail d'un module 
    * @Route("{id}", name="module_affichage", methods={"GET"});
    */
    public function affichageModule($id)
    {
        $parametersAsArray = [];
        $resultat = "OK";
        $repository_client = $this->getDoctrine()->getRepository(Client::class);

        //On verifie si le module existe bien
        if ($resultat == "OK"){
            $repository_module = $this->getDoctrine()->getRepository(Module::class);
            $module = $repository_module->find($id);
            if ($module == null){
                $resultat = "Le module n'existe pas.";
            }
        }
        //Envoi de la réponse 
        if  ($resultat == "OK") {
            $reponse = new Response(json_encode(array(
                'result' => "OK",
                'id' => $module->getId(),
                'tymo_id' => $module->getTymo()->getId(),
                'devi_id' => $module->getDevi()->getId(),
                'cctp_id' => $module->getCctp()->getId(),
                'fiex_id' => $module->getFiex()->getId(),
                'fiin_id' => $module->getFiin()->getId(),
                'couv_id' => $module->getCouv()->getId(),
                'modu_nom' => $module->getNom(),
                'modu_prix_unitaire' => $module->getModuPrixUnitaire(),
                'isol_id' => $module->getIsol()->getId(),
                ))
            );
        } else {
            $reponse = new Response (json_encode(array(
                'result' => $resultat,
                'id' => $id,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /** 
    * Permet de modifier un module
    * @Route("/", methods={"PUT"}) 
    */
    public function modificationModule(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        $parametersAsArray = [];
        $resultat = null;

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }
        //Verification parametres
        $parametresObligatoire[] = array('id', 'tymo_id', 'devi_id', 'cctp_id', 'fiex_id', 'fiin_id', 'couv_id', 'modu_nom', 'modu_prix_unitaire', 'isol_id'); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
     
        // verification du module
        if ($resultat == "OK") {
            $repository_module = $this->getDoctrine()->getRepository(Module::class); 
            $module = $repository_module->find($parametersAsArray['id']); 
            if ($module == null) {
                $resultat =  "Le module n'existe pas.";
            }    
        }

        // verification du type de module
        if (($resultat == "OK") && ($parametersAsArray['tymo_id'] <> null)) {
            $repository_typeModule = $this->getDoctrine()->getRepository(TypeModule::class); 
            $typeModule = $repository_typeModule->find($parametersAsArray['devi_id']); 
            if ($typeModule == null) {
                $resultat =  "Le type module n'existe pas.";
            }    
        }

        // verification du devis
        if (($resultat == "OK") && ($parametersAsArray['devi_id'] <> null)) {
            $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
            $devis = $repository_devis->find($parametersAsArray['devi_id']); 
            if ($devis == null) {
                $resultat =  "Le devis n'existe pas.";
            }    
        }
     
        // verification du cctp
        if ($resultat == "OK") {
            $repository_cctp = $this->getDoctrine()->getRepository(CCTP::class); 
            $cctp = $repository_cctp->find($parametersAsArray['cctp_id']); 
            if ($cctp == null) {
                $resultat =  "Le cctp n'existe pas.";
            }    
        }

        // verification de la finition_exterieur
        if ($resultat == "OK") {
            $repository_finition_exterieur = $this->getDoctrine()->getRepository(FinitionExterieur::class); 
            $finition_exterieur = $repository_finition_exterieur->find($parametersAsArray['fiex_id']); 
            if (($finition_exterieur == null) && ($parametersAsArray['fiex_id'] <> null)) {
                $resultat =  "La finition exterieur n'existe pas.";
            }    
        }

        // verification de la finition_interieur
        if ($resultat == "OK") {
            $repository_finition_interieur = $this->getDoctrine()->getRepository(FinitionInterieur::class); 
            $finition_interieur = $repository_finition_interieur->find($parametersAsArray['fiin_id']); 
            if (($finition_interieur == null) && ($parametersAsArray['fiin_id'] <> null)) {
                $resultat =  "La finition interieur n'existe pas.";
            }    
        }

        // verification de la couverture
        if ($resultat == "OK") {
            $repository_couverture = $this->getDoctrine()->getRepository(Couverture::class); 
            $couverture = $repository_couverture->find($parametersAsArray['couv_id']); 
            if (($couverture == null) && ($parametersAsArray['couv_id'] <> null)) {
                $resultat =  "La couverture n'existe pas.";
            }    
        }

        // verification de la isolant
        if ($resultat == "OK") {
            $repository_isolant = $this->getDoctrine()->getRepository(Isolant::class); 
            $isolant = $repository_isolant->find($parametersAsArray['isol_id']); 
            if (($isolant == null) && ($parametersAsArray['isol_id'] <> null)) {
                $resultat =  "L'isolant n'existe pas.";
            }    
        }

        //Creation du module
		if ($resultat == "OK") {
            $module->setModuNom($parametersAsArray['modu_nom']);
            $module->setTymo($typeModule);
            //$module->setModuPrixUnitaire();
            $module->setCCTP($cctp);
            $module->setFiex($finition_exterieur);
            $module->setFiin($finition_interieur);
            $module->setCouv($couverture);
            $module->setIsol($isolant);
            $entityManager->persist($module); 
            $entityManager->flush();
        }
		
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $module->getId(), 
                'modu_nom' => $module->getModuNom(),
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
    * Permet de supprimer un module
    * @Route("{id}", name="module_suppression", methods={"DELETE"}),
    */
    public function suppressionModule($id){
        $repository_client = $this->getDoctrine()->getRepository(Client::class); 
        $parametersAsArray = [];
        $resultat = "OK";

        //Verification parametres
        if ($resultat == "OK"){
            $entityManager = $this->getDoctrine()->getManager(); 
            $repository_module = $this->getDoctrine()->getRepository(Module::class); 
            $module = $repository_module->find($id);
            if ($module == null) {
                $resultat = "Le module n'existe pas.";
            } else {
                $entityManager->remove($module);
                $entityManager->flush();  
            }
        }
        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $id,
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'resultat' => $resultat,
                'id' => $id,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;        
    }

    /**
    * Permet d'avoir la liste de tous les module 
    * @Route("", name="module_liste", methods={"GET"});
    */
    public function listeModule(Request $requestjson) 
    {
        $resultat = "OK";
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        //Recuperation de la liste de module
        $listeModule = $repository_module->findAll();
        //Verification de la base
        if ($listeModule == null) {
            $resultat = "Aucun module trouvé.";
        }else{
            $listeReponse = array();
            foreach ($listeModule as $module) 
            {
                $listeReponse[] = array(
                    'id' => $module->getId(),
                    'tymo_id' => $module->getTymo(),
                    'modu_nom' => $module->getModuNom()
                );  
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeModule" => $listeReponse,
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
    * Permet d'avoir la liste des modules d'une typeModule 
    * @Route("/liste/gamme/{gamm_id}/type/{tymo_id}", name="module_liste_gamme_type", methods={"GET"});
    */
    public function listeModuleGammeType($gamm_id, $tymo_id) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        $resultat = "OK";

        // Verfication Gamme
        if ($resultat == "OK") {
            $repository_gamme = $this->getDoctrine()->getRepository(Gamme::class); 
            $gamme = $repository_gamme->find($gamm_id); 
            if ($gamme == null) {
                $resultat =  "Le gamme n'existe pas.";
            }    
        }

        // Verfication TypeModule
        if ($resultat == "OK") {
            $repository_typeModule = $this->getDoctrine()->getRepository(TypeModule::class); 
            $typeModule = $repository_typeModule->find($tymo_id); 
            if ($typeModule == null) {
                $resultat =  "Le typeModule n'existe pas.";
            }    
        }

        if ($resultat == "OK"){
            $fiex_id = $gamme->getFiex()->getId();
            $fiin_id = $gamme->getFiin()->getId();     
            $couv_id = $gamme->getCouv()->getId();
            $isol_id = $gamme->getIsol()->getId();

            $listeReponse = $repository_module->rechercheModuleFamille($tymo_id, $fiex_id, $fiin_id, $couv_id, $isol_id);
            if ($listeReponse == null){
                $resultat = "Aucuns résultats."; 
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeModule" => $listeReponse,
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
    * Permet d'avoir la liste des modules d'un devis
    * @Route("/liste/devis/{id}", name="module_liste_devis", methods={"GET"});
    */
    public function listeModuleDevis($id) 
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_module = $this->getDoctrine()->getRepository(Module::class);
        $parametersAsArray = [];
        $resultat = "OK";

        // verification du devis
        $repository_devis = $this->getDoctrine()->getRepository(Devis::class); 
        $devis = $repository_devis->find($id); 
        if ($devis == null) {
            $resultat =  "Le devis n'existe pas.";
        }else {
            $listeReponse = $repository_module->rechercheModuleDevis($id);
            if ($listeReponse == null){
                $resultat = "Aucuns résultats."; 
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeModule" => $listeReponse,
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