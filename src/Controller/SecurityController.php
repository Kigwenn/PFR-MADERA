<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
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
     * @Route("/loginjson", name="app_login")
     */
    public function loginjson(AuthenticationUtils $authenticationUtils): Response
    {
        $user = $this->getUser();

        return $this->json([$user->getCredentials()]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }
}
