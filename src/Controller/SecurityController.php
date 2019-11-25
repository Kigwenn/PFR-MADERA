<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/loginj", name="app_login")
     */
    public function loginj(AuthenticationUtils $authenticationUtils): Response
    {
        //Retourne une erreur s'il le login n'est pas bon
        $error = $authenticationUtils->getLastAuthenticationError();
        
        //Renvoi le lastUsername si c'est ok
        $lastUsername = $authenticationUtils->getLastUsername();

        $response = new Response();
        $response->setContent(json_encode(['last_username' => $lastUsername, 'error' => $error]));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

        //return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request): Response
    {
        $json = '{
            "mailUtilisateur": "a@a.com",
            "mdpUtilisateur": "admin"
        }';
        $data = json_decode($json->getContent(), true);
        
        //$user = $this->getUser();

        $response = new Response();
        //$response->setContent(json_encode(['last_username' => "utilisateur", 'error' => "ya po d'erreurs"]));
        //$response->headers->set('Content-Type', 'application/json');
        //return $response;
        //return $this->json([$user->getCredentials()]);
        return $response->setContent($data);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
