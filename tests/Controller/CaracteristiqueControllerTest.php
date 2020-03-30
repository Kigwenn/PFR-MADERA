<?php

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CaracteristiqueControllerTest extends WebTestCase
{
    private $client = null;

    public function testCaracteristiqueCRUD()
    {
        //creation caracteristique
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/PFR-MADERA/caracteristique',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "modu_id": 1,
                "cara_section": 1,
                "cara_hauteur": 1,
                "cara_longueur": 1,
                "cara_type_angle": "testcaraangle",
                "cara_angle": 45
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
            '/PFR-MADERA/caracteristique/'.$testid.'',
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
        $this->assertSame(1,$responseData["modu_id"]);
        $this->assertSame(1,$responseData["cara_section"]);
        $this->assertSame(1,$responseData["cara_hauteur"]);
        $this->assertSame(1,$responseData["cara_hauteur"]);
        $this->assertSame(1,$responseData["cara_longueur"]);
        $this->assertSame("testcaraangle",$responseData["cara_type_angle"]);
        $this->assertSame(45,$responseData["cara_angle"]);

        //Modification de caracteristique
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/caracteristique',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "id": '.$testid.',
                "modu_id": 1,
                "cara_section": 1,
                "cara_hauteur": 1,
                "cara_longueur": 1,
                "cara_type_angle": "caraangle",
                "cara_angle": 90
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
            '/PFR-MADERA/caracteristique/'.$testid.'',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            ''
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);//réduir les test array ?
        $this->assertSame($testid,$responseData["id"]);
        $this->assertSame(1,$responseData["modu_id"]);
        $this->assertSame(1,$responseData["cara_section"]);
        $this->assertSame(1,$responseData["cara_hauteur"]);
        $this->assertSame(1,$responseData["cara_hauteur"]);
        $this->assertSame(1,$responseData["cara_longueur"]);
        $this->assertSame("caraangle",$responseData["cara_type_angle"]);
        $this->assertSame(90,$responseData["cara_angle"]);

        //Vérification de la suppression
        $client = static::createClient();
        $crawler = $client->request(
            'DELETE',
            '/PFR-MADERA/caracteristique/'.$testid.'',
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