<?php

namespace App\Controller;

use App\Entity\TypeUtilisateur;
use App\Entity\Utilisateur;
use App\Entity\Adresse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="utilisateur")
     * 
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /** 
    * Permet de créer un utilisateur et son adresse 
    * @Route("/creation/{nom}/{prenom}/{mail}/{tel}/{mdp}/{type}/{rue}/{ville}/{cp}/{region}", name="utilisateur_creation", methods={"POST"}) 
    */
    public function creationUtilisateur(string $nom, string $prenom,string $mail,string $tel,string $mdp, int $type, string $rue, string $ville, string $cp, string $region)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        
        $listeUtilisateur = $repository->findAll();
        $listeReponse = array();
        $utilisateurValide = true;
        foreach ($listeUtilisateur as $utilisateur) 
        {
            // On récupère l'objet TypeUtilisateur
            $typeUtilisateur = $utilisateur->getTypeUtilisateur();
            // on enregistre les utilisateur correspondant au type mis en paramètre
            if (($typeUtilisateur->getId() == $type) && ($utilisateur->getNomUtilisateur() == $nom) &&
            ($utilisateur->getPrenomUtilisateur() == $prenom) && ($utilisateur->getMailUtilisateur() == $mail)){
                $utilisateurValide = false;
                break;       
            }
        }

        if  ($utilisateurValide == true) {
            //Creation de l'adresse
            $adresse = new Adresse();
            $adresse->setRueAdresse($rue);
            $adresse->setVilleAdresse($ville);
            $adresse->setCpAdresse($cp);
            $adresse->setRegionAdresse($region);
            $entityManager->persist($adresse);

            //Recuperation du type d'utilisateur
            $repository_typeUtilisateur = $this->getDoctrine()->getRepository(TypeUtilisateur::class); 
            $typeUtilisateur = $repository_typeUtilisateur->find($type);

            //Creation de l'utilisateur
            $utilisateur = new Utilisateur(); 
            $utilisateur->setNomUtilisateur($nom);
            $utilisateur->setPrenomUtilisateur($prenom);
            $utilisateur->setMailUtilisateur($mail);
            $utilisateur->setTelUtilisateur($tel);
            $utilisateur->setMdpUtilisateur($mdp);
            $utilisateur->setTypeUtilisateur($typeUtilisateur);
            $utilisateur->setAdresseUtilisateur($adresse); 
            $entityManager->persist($utilisateur); 

            $entityManager->flush();
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $utilisateur->getId(), 
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(), 
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                )
            ));

        } else {
            $reponse = new Response (json_encode(array(
                'result' => "KO",
                'id' => "", 
                'nom_utilisateur' => $nom, 
                'prenom_utilisateur' => $prenom,
                )
            ));
        }

        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }



    /** 
    * Permet de créer un utilisateur et son adresse 
    * @Route("/creationjson", name="utilisateur_creationjson", methods={"POST"}) 
    */
    public function creationUtilisateurJson(Request $requestjson)
    {		
        $request = json_decode($requestjson);
        $nom_utilisateur = $request->{'nom_utilisateur'}; 
		$prenom_utilisateur = $request->{'prenom_utilisateur'}; 
		$mail_utilisateur = $request->{'mail_utilisateur'}; 
		$tel_utilisateur = $request->{'tel_utilisateur'}; 
		$mdp_utilisateur = $request->{'mdp_utilisateur'}; 
		$type_utilisateur_id = $request->{'type_utilisateur_id'}; 
		$rue_adresse = $request->{'rue_adresse'}; 
		$ville_adresse = $request->{'ville_adresse'}; 
		$cp_adresse = $request->{'cp_adresse'}; 
		$region_adresse = $request->{'region_adresse'}; 
	
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        
        $listeUtilisateur = $repository->findAll();
        $listeReponse = array();
        $utilisateurValide = true;

        foreach ($listeUtilisateur as $utilisateur) 
        {
            // On récupère l'objet TypeUtilisateur
            $typeUtilisateur = $utilisateur->getTypeUtilisateur();
            // on enregistre les utilisateur correspondant au type mis en paramètre
            if (($typeUtilisateur->getId() == $type_utilisateur_id) && ($utilisateur->getNomUtilisateur() == $nom_utilisateur ) &&
            ($utilisateur->getPrenomUtilisateur() == $prenom_utilisateur) && ($utilisateur->getMailUtilisateur() == $mail_utilisateur)){
                $utilisateurValide = false;
                break;       
            }
        }

        if  ($utilisateurValide == true) {
            //Creation de l'adresse
            $adresse = new Adresse();
            $adresse->setRueAdresse($rue_adresse);
            $adresse->setVilleAdresse($ville_adresse);
            $adresse->setCpAdresse($cp_adresse);
            $adresse->setRegionAdresse($region_adresse);
            $entityManager->persist($adresse);

            //Recuperation du type d'utilisateur
            $repository_typeUtilisateur = $this->getDoctrine()->getRepository(TypeUtilisateur::class); 
            $typeUtilisateur = $repository_typeUtilisateur->find($type_utilisateur_id);

            //Creation de l'utilisateur
            $utilisateur = new Utilisateur(); 
            $utilisateur->setNomUtilisateur($nom_utilisateur);
            $utilisateur->setPrenomUtilisateur($prenom_utilisateur);
            $utilisateur->setMailUtilisateur($mail_utilisateur);
            $utilisateur->setTelUtilisateur($tel_utilisateur);
            $utilisateur->setMdpUtilisateur($mdp_utilisateur);
            $utilisateur->setTypeUtilisateur($typeUtilisateur);
            $utilisateur->setAdresseUtilisateur($adresse); 
            $entityManager->persist($utilisateur); 

            $entityManager->flush();
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $utilisateur->getId(), 
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(), 
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                )
            ));

        } else {
            $reponse = new Response (json_encode(array(
                'result' => "KO",
                'id' => "", 
                'nom_utilisateur' => $nom_utilisateur, 
                'prenom_utilisateur' => $prenom_utilisateur,
                )
            ));
        }

        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }






    
    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste/{nomType}", name="utilisateur_liste", methods={"GET"});
    */
    public function listeUtilisateur(String $nomType) 
    {
        $repository = $this->getDoctrine()->getRepository(Utilisateur::class);
        $listeUtilisateur = $repository->findAll();
        $listeReponse = array();
        foreach ($listeUtilisateur as $utilisateur) 
        {
            // On récupère l'objet TypeUtilisateur
            $typeUtilisateur = $utilisateur->getTypeUtilisateur();
            // on enregistre les utilisateur correspondant au type mis en paramètre
            if ($typeUtilisateur->getNomType() == $nomType){
                $listeReponse[] = array(
                    'id' => $utilisateur->getId(),
                    'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
                    'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                    'mail_utilisateur' => $utilisateur->getMailUtilisateur(),
                    'tel_utilisateur' => $utilisateur->getTelUtilisateur(),
                    'mdp_utilisateur' => $utilisateur->getMdpUtilisateur(),
                );
            }
        }
        $reponse = new Response(); 
        $reponse->setContent(json_encode(array("utilisateur"=>$listeReponse))); 
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }
  
    /**
    * Permet d'avoir le detail d'un utilisateurs 
    * @Route("/detail/{id}", name="utilisateur_detail", methods={"GET"});
    */
    public function detailUtilisateur(int $id) 
    {
        //Recupération utilisateur
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
        $utilisateur = $repository_utilisateur->find($id);

        //Recupération adresse
        $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class);  
        $adresse = $repository_adresse->find($utilisateur->getAdresseUtilisateur());

        $reponse = new Response(json_encode(array(
            'id' => $utilisateur->getId(),
            'nom_utilisateur' => $utilisateur->getNomUtilisateur(),
            'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
            'mail_utilisateur' => $utilisateur->getMailUtilisateur(),
            'tel_utilisateur' => $utilisateur->getTelUtilisateur(),
            'mdp_utilisateur' => $utilisateur->getMdpUtilisateur(),
            'type_utilisateur' => $utilisateur->getTypeUtilisateur()->getId(),
            'rue_adresse' => $adresse->getRueAdresse(),
            'ville_adresse' => $adresse->getVilleAdresse(),
            'cp_adresse' => $adresse->getCpAdresse(),
            'region_adresse' => $adresse->getRegionAdresse(),
            ))
        );
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /** 
    * Permet de modifier un utilisateur grâce à son id 
    * La gestion des devis de l'utilisateur se fera via l'entité devis 
    * @Route("/modification/{id}/{nom}/{prenom}/{mail}/{tel}/{mdp}/{type}/{rue}/{ville}/{cp}/{region}", name="utilisateur_modification", methods={"PUT"}) 
    */
    
    public function modificationUtilisateur(int $id, string $nom, string $prenom,string $mail,string $tel,string $mdp, string $rue, string $ville, string $cp, string $region){
        $entityManager = $this->getDoctrine()->getManager();  
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class);
        $listeUtilisateur = $repository_utilisateur->findAll();
        $listeReponse = array();
        $utilisateurValide = true;

        foreach ($listeUtilisateur as $utilisateur) 
        {
            // On récupère l'objet TypeUtilisateur
            $typeUtilisateur = $utilisateur->getTypeUtilisateur();
            // on enregistre les utilisateur correspondant au type mis en paramètre
            if (($typeUtilisateur->getId() == 1) && ($utilisateur->getNomUtilisateur() == $nom) &&
            ($utilisateur->getPrenomUtilisateur() == $prenom) && ($utilisateur->getMailUtilisateur() == $mail)){
                $utilisateurValide = false;
                break;       
            }
        }

        if  ($utilisateurValide == true) {
            //Modification de l'utilisateur 
            $utilisateur = $repository_utilisateur->find($id); 
            $utilisateur->setNomUtilisateur($nom);
            $utilisateur->setPrenomUtilisateur($prenom);
            $utilisateur->setMailUtilisateur($mail);
            $utilisateur->setTelUtilisateur($tel);
            $utilisateur->setMdpUtilisateur($mdp);
            $entityManager->persist($utilisateur); 
            
            //Modification de l'adresse
            $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class); 
            $adresse = $repository_adresse->find($utilisateur->getAdresseUtilisateur());
            $adresse->setRueAdresse($rue);
            $adresse->setVilleAdresse($ville);
            $adresse->setCpAdresse($cp);
            $adresse->setRegionAdresse($region);
            $entityManager->persist($adresse);

            $entityManager->flush();
            $reponse = new Response (json_encode(array(
                'result' => "OK",
                'id' => $utilisateur->getId(), 
                'nom_utilisateur' => $utilisateur->getNomUtilisateur(), 
                'prenom_utilisateur' => $utilisateur->getPrenomUtilisateur(),
                )
            ));
        } else {
            $reponse = new Response (json_encode(array(
                'result' => "KO",
                'id' => "", 
                'nom_utilisateur' => $nom, 
                'prenom_utilisateur' => $prenom,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }  

      
    /** 
    * Permet de supprimer un utilisateur et son adresse grâce à l'id de l'utilisateur
    * @Route("/suppression/{id}", name="utilisateur_suppression", methods={"DELETE"}),
    */
    public function suppressionUtilisateur($id){
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class); 
        $repository_adresse = $this->getDoctrine()->getRepository(Adresse::class); 
        $utilisateur = $repository_utilisateur->find($id); 
        $adresse = $repository_adresse->find($utilisateur->getAdresseUtilisateur());
        $entityManager->remove($utilisateur); 
        $entityManager->remove($adresse); 
        $entityManager->flush(); 

        $reponse = new Response (json_encode (array(
            'result' => "OK",
            )) 
        ); 
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;        
    }

 
}
