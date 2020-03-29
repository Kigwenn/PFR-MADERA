<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ModuleControllerTest extends WebTestCase
{
    private $client = null;

    public function testModuleCRUD()
    {
        //creation caracteristique
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/PFR-MADERA/module',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "modu_id": 1,
                "tymo_id": 1,
                "devi_id": 1,
                "cctp_id": 1,
                "fiex_id": 1,
                "fiin_id": 1,
                "couv_id": 1,
                "modu_nom": "testnom",
                "modu_prix_unitaire": 2525,
                "isol_id": 1
            }'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertGreaterThan(0,$responseData["id"]);
        $testid = $responseData["id"];

        //Vérification des données
        $client = static::createClient();
        $crawler = $client->request(
            'GET',
            '/PFR-MADERA/module/'.$testid.'',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            ''
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);
        $this->assertSame("testnom",$responseData["modu_nom"]);
        $this->assertSame(2525,$responseData["cara_modu_prix_unitairehauteur"]);

        //Modification de caracteristique
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/module',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "id": 1,
                "tymo_id": 1,
                "devi_id": 1,
                "cctp_id": 1,
                "fiex_id": 1,
                "fiin_id": 1,
                "couv_id": 1,
                "modu_nom": "testmodule2",
                "modu_prix_unitaire": 2222,
                "isol_id": 1
            }'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);

        //Vérification des données
        $client = static::createClient();
        $crawler = $client->request(
            'GET',
            '/PFR-MADERA/module/'.$testid.'',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            ''
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);
        $this->assertSame("testmodule2",$responseData["modu_nom"]);
        $this->assertSame(2222,$responseData["cara_modu_prix_unitairehauteur"]);

        //Vérification de la suppression
        $client = static::createClient();
        $crawler = $client->request(
            'DELETE',
            '/PFR-MADERA/module/'.$testid.'',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            ''
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);
    }
}