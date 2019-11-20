<?php

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilisateurControllerTest extends WebTestCase
{
    private $client = null;

    public function testDetailUtilisateur()
    {
        //$utilisateur = static::new Utilisateur();
        $client = static::createClient();
        $client->request('GET', '/PFR-MADERA/utilisateur/detail/3');
        //$type = $client->query->get('type_utilisateur');
        //echo($type);
        echo ($this->client->getResponse()->getStatusCode());
        $this->assertEquals(1, 1);
    }
}