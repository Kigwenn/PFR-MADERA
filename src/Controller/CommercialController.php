<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\Commercial;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
//    /**
//     * @Route("/", name="commercial")
//     *
//     */
//    public function index()
//    {
//        return $this->render('commercial/index.html.twig', [
//            'controller_name' => 'CommercialController',
//        ]);
//    }

    /** 
    * Permet de créer un commercial et son adresse 
    * @Route("", name="commercial_creation", methods={"POST"}) 
    */
    public function creationCommercial(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        $repository_client =  $this->getDoctrine()->getRepository(Client::class); 
        $parametersAsArray = [];
        $resultat = "OK";

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('pers_sexe', 'pers_nom', 'pers_prenom', 'pers_mail','pers_tel', 'comm_mdp', 'id');
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du pays et du commercial
        if ($resultat == "OK")
        {
            if (count($repository_commercial->commercialExistant($parametersAsArray['pers_nom'],
            $parametersAsArray['pers_prenom'], $parametersAsArray['pers_mail'])) > 0){
                $resultat =  "Commercial déjà existant.";
            }
        }

        //Creation du commercial
        if  ($resultat == "OK") {
            $commercial = new Commercial();
            $commercial->setPersSexe($parametersAsArray['pers_sexe']);
            $commercial->setPersNom($parametersAsArray['pers_nom']);
            $commercial->setPersPrenom($parametersAsArray['pers_prenom']);
            $commercial->setPersMail($parametersAsArray['pers_mail']);
            $commercial->setPersTel($parametersAsArray['pers_tel']);
            $commercial->setCommMdp($parametersAsArray['comm_mdp']); 
            $entityManager->persist($commercial); 
            $entityManager->flush();
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $commercial->getId()
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
    * Permet d'avoir le detail d'un commercials 
    * @Route("{id}", name="commercial_affichage", methods={"GET"});
    */
    public function affichageCommercial(int $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = "OK";

        //On verifie si le commercial existe bien
        if ($resultat == "OK"){
            $listeCommercial = $repository_commercial->findAll();
            $commercial = null;
            foreach ($listeCommercial as $c) 
            {
                if ($c->getId() == $id){
                    $commercial = $c;
                    break;
                }  
            }
            if ($commercial == null){
                $resultat = "Le commercial n'existe pas.";
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response(json_encode(array(
                'resultat' => "OK",
                'id' => $commercial->getId(),
                'pers_sexe' => $commercial->getPersSexe(),
                'pers_nom' => $commercial->getPersNom(),
                'pers_prenom' => $commercial->getPersPrenom(),
                'pers_mail' => $commercial->getPersMail(),
                'pers_tel' => $commercial->getPersTel(),
                'comm_mdp' => $commercial->getCommMdp()
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
    * Permet de modifier un commercial et son adresse 
    * @Route("", name="commercial_modification", methods={"PUT"}) 
    */
    public function modificationCommercial(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        $parametersAsArray = [];
        $resultat = "OK";

        //Conversion du JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('id', 'pers_sexe', 'pers_nom', 'pers_prenom', 'pers_mail','pers_tel', 'comm_mdp');
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du pays et du commercial
        if ($resultat == "OK")
        {
            $listeCommercial = $repository_commercial->findAll();
            $commercial = null;
            foreach ($listeCommercial as $c) 
            {
                if ($c->getId() == $parametersAsArray['id']){
                    $commercial = $c;
                    break;
                }  
            }
            if ($commercial == null){
                $resultat = "Le commercial n'existe pas.";
            } else if (count($repository_commercial->commercialExistant($parametersAsArray['pers_nom'],
            $parametersAsArray['pers_prenom'], $parametersAsArray['pers_mail'])) > 0) 
            {
                $resultat =  "Commercial déjà existant.";          
            }
        }

        //Modification du commercial
        if  ($resultat == "OK") {
            $commercial->setPersSexe($parametersAsArray['pers_sexe']);
            $commercial->setPersNom($parametersAsArray['pers_nom']);
            $commercial->setPersPrenom($parametersAsArray['pers_prenom']);
            $commercial->setPersMail($parametersAsArray['pers_mail']);
            $commercial->setPersTel($parametersAsArray['pers_tel']);
            $commercial->setCommMdp($parametersAsArray['comm_mdp']); 
            $entityManager->persist($commercial); 
            $entityManager->flush();
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $commercial->getId()
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
    * Permet de supprimer un commercial et son adresse grâce à l'id de l'commercial
    * @Route("{id}", name="commercial_suppression", methods={"DELETE"}),
    */
    public function suppressionCommercial(int $id){
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class); 
        $repository_client = $this->getDoctrine()->getRepository(Client::class); 
        $parametersAsArray = [];
        $resultat = "OK";

        //Verification parametres
        if ($resultat == "OK"){
            $listeCommercial = $repository_commercial->findAll();
            //On verifie si le commercial existe bien
            if ($resultat == "OK"){
                $commercial = null;
                foreach ($listeCommercial as $c) 
                {
                    if ($c->getId() == $id){
                        $commercial = $c;
                        break;
                    }  
                }
                if ($commercial == null){
                    $resultat = "Le commercial n'existe pas.";
                }
            }
        }

        //Envoi de la réponse 
        if  ($resultat == "OK") { 
            //Suppression
            $entityManager->remove($commercial);
            $entityManager->flush();  
            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'cid' => $id,
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
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("", name="commercial_liste", methods={"GET"});
    */
    public function listeCommercial(Request $requestjson) 
    {
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        //Recuperation de la liste de commercial
        $listeCommercial = $repository_commercial->findAll();
        // on vérifie si il y a bien une liste de commercial
        if ($listeCommercial == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucun commercial trouvé.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeCommercial as $commercial) 
            {
                $listeReponse[] = array(
                    'id' => $commercial->getId(),
                    'pers_nom' => $commercial->getPersNom(),
                    'pers_prenom' => $commercial->getPersPrenom(),
                    'pers_mail' => $commercial->getPersMail(),
                );
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeCommercials" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access Control-Allow-Origin", "*");
        return $reponse;
    }
    /**
     * Permet d'avoir la liste de tous les utilisateurs
     * @Route("count", name="commercial_count", methods={"GET"});
     */
    public function countCommercial()
    {
        $repository_commercial = $this->getDoctrine()->getRepository(Commercial::class);
        //Recuperation de la liste de commercial
        $listeCommercial = $repository_commercial->findAll();
        $count = count($listeCommercial);
        $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "count" => $count
            )));
        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access Control-Allow-Origin", "*");
        return $reponse;
    }

}
