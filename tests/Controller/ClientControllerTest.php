<?php

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    private $client = null;

    public function testClientCRUD()
    {
        //creation client
        print_r("C");
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"pers_sexe": "homme", 
            "pers_nom": "nomtest", 
            "pers_prenom": "prenomtest", 
            "pers_mail": "mail@test.com", 
            "pers_tel": "1234567891", 
            "pays_id": 1, 
            "adre_rue": "ruetest", 
            "adre_ville": "villetest", 
            "adre_cp": "12345", 
            "adre_region": "regiotest", 
            "adre_complement": "complementest", 
            "adre_info": "infotest"}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertGreaterThan(0,$responseData["id"]);
        $testid = $responseData["id"];

        //Vérification des données
        print_r("V");
        $client = static::createClient();
        $crawler = $client->request(
            'GET',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"clie_id": '.$testid.'}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);//réduir les test array ?
        $this->assertSame($testid,$responseData["id"]);
        $this->assertSame("homme",$responseData["pers_sexe"]);
        $this->assertSame("nomtest",$responseData["pers_nom"]);
        $this->assertSame("prenomtest",$responseData["pers_prenom"]);
        $this->assertSame("mail@test.com",$responseData["pers_mail"]);
        $this->assertSame(1,$responseData["pays_id"]);
        $this->assertSame("regiotest",$responseData["regiotest"]);

        //Modification du client
        print_r("M");
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"pays_id": 1,
                "adre_region": "region2",
                "adre_ville": "ville2",
                "adre_cp": "54321",
                "adre_rue": "rue2",
                "adre_complement": "compl2",
                "adre_info": "info2",
                "clie_id": '.$testid.',
                "pers_sexe": "femme",
                "pers_nom": "nom2",
                "pers_prenom": "prenom2",
                "pers_mail": "test@mail2.fr",
                "pers_tel": "753914268"}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);

        //Vérification des données
        print_r("V");
        $client = static::createClient();
        $crawler = $client->request(
            'GET',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"clie_id": '.$testid.'}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);//réduir les test array ?
        $this->assertSame($testid,$responseData["id"]);
        $this->assertSame("femme",$responseData["pers_sexe"]);
        $this->assertSame("nom2",$responseData["pers_nom"]);
        $this->assertSame("prenom2",$responseData["pers_prenom"]);
        $this->assertSame("test@mail2.fr",$responseData["pers_mail"]);
        $this->assertSame(1,$responseData["pays_id"]);
        $this->assertSame("region2",$responseData["regiotest"]);

        //Vérification de la suppression
        print_r("D");
        $client = static::createClient();
        $crawler = $client->request(
            'DELETE',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"clie_id": '.$testid.'}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);
    }

    public function testlisteClient()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/PFR-MADERA/client/liste');
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
    }

    /*public function testcreationClient()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"pers_sexe": "homme", 
            "pers_nom": "nomtest", 
            "pers_prenom": "prenomtest", 
            "pers_mail": "mail@test.com", 
            "pers_tel": "1234567891", 
            "pays_id": 1, 
            "adre_rue": "ruetest", 
            "adre_ville": "villetest", 
            "adre_cp": "12345", 
            "adre_region": "regiotest", 
            "adre_complement": "complementest", 
            "adre_info": "infotest"}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertGreaterThan(0,$responseData["id"]);
        $testid = $responseData["id"];
        print_r($testid);
    }*/

    /*public function testmodificationClient()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/client',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"pays_id": 1,
                "adre_region": "region2",
                "adre_ville": "ville2",
                "adre_cp": "54321",
                "adre_rue": "rue2",
                "adre_complement": "compl2",
                "adre_info": "info2",
                "clie_id": '.$testid.',
                "pers_sexe": "femme",
                "pers_nom": "nom2",
                "pers_prenom": "prenom2",
                "pers_mail": "test@mail2.fr",
                "pers_tel": "753914268"}'
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
        $this->assertSame("OK", $responseData["resultat"]);
        $this->assertSame($testid,$responseData["id"]);
        //print_r(testid);
    }*/

        /*public function testaffichageClient()
        {
            $client = static::createClient();
            $crawler = $client->request(
                'GET',
                '/PFR-MADERA/client',
                array(),
                array(),
                array('CONTENT_TYPE' => 'application/json'),
                '{"clie_id": '.$testid.'}'
            );
            $response = $client->getResponse();
            $this->assertSame(200, $response->getStatusCode());//test route
            $responseData = json_decode($response->getContent(), true);
            $this->assertSame("OK", $responseData["resultat"]);
            $this->assertSame($testid,$responseData["id"]);
        }*/

        /*public function testsuppressionClient()
        {
            $client = static::createClient();
            $crawler = $client->request(
                'DELETE',
                '/PFR-MADERA/client',
                array(),
                array(),
                array('CONTENT_TYPE' => 'application/json'),
                '{"clie_id": '.$testid.'}'
            );
            $response = $client->getResponse();
            $this->assertSame(200, $response->getStatusCode());//test route
            $responseData = json_decode($response->getContent(), true);
            $this->assertSame("OK", $responseData["resultat"]);
            $this->assertSame($testid,$responseData["id"]);

            //Re-testaffichage ?
        }*/
}