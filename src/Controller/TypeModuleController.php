<?php

namespace App\Controller;
use App\Entity\TypeModule;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeModuleController extends AbstractController
{
    /**
     * @Route("/type_module", name="type_module")
     */
    public function index()
    {
        return $this->render('type_module/index.html.twig', [
            'controller_name' => 'TypeModuleController',
        ]);
    }

    /**
    * Permet d'avoir la liste de tous les utilisateurs 
    * @Route("/liste", name="type_module_liste", methods={"GET"});
    */
    public function listeTypeModule(Request $requestjson) 
    {
        $repository_type_module = $this->getDoctrine()->getRepository(TypeModule::class);
        //Recuperation de la liste de type_module
        $listeTypeModule = $repository_type_module->findAll();
        // on vérifie si il y a bien une liste de type_module
        if ($listeTypeModule == null) {
            $reponse = new Response (json_encode(array(
                'resultat' => "Aucun type_module trouvée.",
                )
            ));
        } else {
            $listeReponse = array();
            foreach ($listeTypeModule as $type_module) 
            {
                $listeReponse[] = array(
                    'id' => $type_module->getId(),
                    'tymo_nom' => $type_module->getTymoNom()
                );  
            }

            $reponse = new Response (json_encode(array(
                'resultat' => "OK",
                "listeTypeModule" => $listeReponse,
                )
            ));
        }
        $reponse->headers->set("Content-Type", "application/json"); 
        $reponse->headers->set("Access-Control-Allow-Origin", "*"); 
        return $reponse;
    }  
    
    
}
