<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Module;
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
    * Permet de créer un caracteristique et son adresse 
    * @Route("", name="caracteristique_creation", methods={"POST"}) 
    */
    public function creationCaracteristique(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class);
        $parametersAsArray = [];

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('modu_id', 'cara_section', 'cara_hauteur', 'cara_longueur', 'cara_type_angle', 'cara_degre_angle');
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du module
        $repository_module = $this->getDoctrine()->getRepository(Module::class); 
        $module = $repository_module->find($parametersAsArray['modu_id']); 
        if ($module == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Le module n'existe pas."
                )
            ));
        } else {
            //Creation
            $caracteristique = new Caracteristique();
            $caracteristique->setModu($module);
            $caracteristique->setCaraSection($parametersAsArray['cara_section']);
            $caracteristique->setCaraHauteur($parametersAsArray['cara_hauteur']);
            $caracteristique->setCaraLongueur($parametersAsArray['cara_longueur']);
            $caracteristique->setCaraTypeAngle($parametersAsArray['cara_type_angle']);
            $caracteristique->setCaraDegreAngle($parametersAsArray['cara_angle']);
            $entityManager->persist($caracteristique); 
            $entityManager->flush();

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                'id' => $caracteristique->getId()
                )
            ));
        }    

        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

     /**
    * Permet d'avoir le detail d'un caracteristiques 
    * @Route("/{id}", name="caracteristique_affichage", methods={"GET"});
    */
    public function affichageCaracteristique($id)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $resultat = "OK";
        //On verifie si la caracteristique existe bien
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class); 
        $caracteristique = $repository_caracteristique->find($id); 
        if ($caracteristique == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Caracteristique introuvable.",
                'id' => $id
                )
            ));
        } else {
            $reponse = new Response(json_encode(array(
                'resultat' => "OK",
                'id' => $caracteristique->getId(),
                'modu_id' => $caracteristique->getModu()->getId(),
                'cara_section' => $caracteristique->getCaraSection(),
                'cara_hauteur' => $caracteristique->getCaraHauteur(),
                'cara_longueur' => $caracteristique->getCaraLongueur(),
                'cara_type_angle' => $caracteristique->getCaraTypeAngle(),
                'cara_angle' => $caracteristique->getCaraDegreAngle()
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access Control-Allow-Origin", "*"); 
        return $reponse;
    }

    /** 
    * Permet de modifier un caracteristique et son adresse 
    * @Route("", name="caracteristique_modification", methods={"PUT"}) 
    */
    public function modificationCaracteristique(Request $requestjson)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class);
        $parametersAsArray = [];
        $resultat = "OK";

        //Conversion dU JSON
        if ($content = $requestjson->getContent()) {
            $parametersAsArray = json_decode($content, true);
        }

        //Vérification des parametres
        $parametresObligatoire[] = array('id', 'modu_id', 'cara_section', 'cara_hauteur', 'cara_longueur', 'cara_type_angle', 'cara_degre_angle');
        $repository_client = $this->getDoctrine()->getRepository(Client::class);
        $resultat = $repository_client->verificationParametre($parametresObligatoire[0], $parametersAsArray);
        // Vérification du module
        if ($resultat == "OK")
        {
            $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class); 
            $caracteristique = $repository_caracteristique->find($parametersAsArray['id']); 
            if ($caracteristique == null) {
                $resultat =  "Caracteristique introuvable.";
            } else {
                $repository_module = $this->getDoctrine()->getRepository(Module::class); 
                $module = $repository_module->find($parametersAsArray['modu_id']); 
                if ($module == null) {
                    $reponse = "Le module n'existe pas.";
                } else {
                    //Modification
                    $caracteristique->setModu($module);
                    $caracteristique->setCaraSection($parametersAsArray['cara_section']);
                    $caracteristique->setCaraHauteur($parametersAsArray['cara_hauteur']);
                    $caracteristique->setCaraLongueur($parametersAsArray['cara_longueur']);
                    $caracteristique->setCaraTypeAngle($parametersAsArray['cara_type_angle']);
                    $caracteristique->setCaraDegreAngle($parametersAsArray['cara_degre_angle']);
                    $entityManager->persist($caracteristique); 
                    $entityManager->flush();

                    $reponse = new Response (json_encode(array(
                        'resultat' => "OK",
                        'id' => $caracteristique->getId()
                        )
                    ));
                }
            }
        }
        if ($resultat <> "OK") {
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
    * Permet de supprimer un caracteristique et son adresse grâce à l'id de l'caracteristique
    * @Route("/liste/module/{id}", name="caracteristique_suppression", methods={"DELETE"}),
    */
    public function suppressionCaracteristique($id){
        $entityManager = $this->getDoctrine()->getManager(); 
        $caracteristique = null;
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class); 
        $caracteristique = $repository_caracteristique->find($id); 
        if ($caracteristique == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Caracteristique introuvable.",
                'id' => $id
                )
            ));
        } else {
            //Suppression
            $entityManager->remove($caracteristique);
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
    * Permet d'avoir la liste de tous les caracteristiques
    * @Route("/liste/module/{id}", name="caracteristique_liste_module", methods={"GET"});
    */
    public function listeCaracteristiqueModule($id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager(); 
        $repository_caracteristique = $this->getDoctrine()->getRepository(Caracteristique::class);
        $resultat = "OK";

        $nb_pages = $request->query->get('page');
        $q = $request->query->get('q');

        $nb_pages = !empty($nb_pages) ? $nb_pages * 10 : $nb_pages = 10;
        $first  = $nb_pages - 10;
        $last  = $first + 9;

        $listeCara = $repository_caracteristique->rechercheCaracteristiqueModule($id);

        $newListe = [];

        if ( !empty($q) ) {
            foreach ($listeCara as $cara) {
                foreach ($cara as $key => $value) {
                    if ( strpos($value, $q) !== false ) {
                        $newListe[] = $cara;
                        break;
                    }
                }
            }
        }
        else $newListe = $listeCara;

        if ($listeCara == null){
            $resultat = "Aucuns résultats.";
        }
        else {
            $listeReponse = [];
            foreach ($newListe as $key => $carac) {
                if (($key >= $first) && ($key <= $last)) {
                    $listeReponse[] = $carac;
                }
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

    /**
     * Permet d'avoir le nombre de caracteristiques
     * @Route("/liste/module/{id}/count", name="caracteristique_liste_modules_count", methods={"GET"});
     */
    public function countListeCaracteristiqueModule($id)
    {
        $qb = $this->getDoctrine()->getManager();
        $qb = $qb->createQueryBuilder();
        $qb->select('c')
            ->from('App\Entity\Caracteristique', 'c')
            ->where('c.modu = :id')
            ->setParameter('id', $id);
        $query = $qb->getQuery();
        $result = $query->execute();

        $count = count($result);
        $reponse = new Response (json_encode(array(
            'resultat' => "OK",
            "count" => $count
        )));
        $reponse->headers->set("Content-Type", "application/json");
        $reponse->headers->set("Access-Control-Allow-Origin", "*");
        return $reponse;
    }
}
