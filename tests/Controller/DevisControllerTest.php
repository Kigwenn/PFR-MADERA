<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DevisControllerTest extends WebTestCase
{
    private $client = null;

    public function testDevisCRUD()
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/PFR-MADERA/devis',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '"mais_id": 1,
            "gamm_id": 1,
            "comm_id": 1,
            "clie_id": 1,
            "devi_nom": "devis 1",
            "devi_date": {
                "date": "2019-12-24 00:00:00.000000",
                "timezone_type": 3,
                "timezone": "Europe/Berlin"
            },
            "pays_id": 1,
            "adre_region": "adretest",
            "adre_ville": "villetest",
            "adre_cp": "11111",
            "adre_rue": "ruetest",
            "adre_complement": "adrecomtest",
            "adre_info": "adreinfotest"'
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
            '/PFR-MADERA/commercial',
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
        $this->assertSame("nomtestcom",$responseData["pers_nom"]);
        $this->assertSame("pretestcom",$responseData["pers_prenom"]);
        $this->assertSame("mailtest@commercial.fr",$responseData["pers_mail"]);
        $this->assertSame("0987654321",$responseData["pers_tel"]);
        $this->assertSame("testmdpcom",$responseData["comm_mdp"]);

        //Modification du commercial
        print_r("M");
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/commercial',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "comm_id": '.$testid.',
                "pers_sexe": "femme",
                "pers_nom": "nomtestcomedit",
                "pers_prenom": "pretestcomedit",
                "pers_mail": "mailtestedit@commercial.com",
                "pers_tel": "0000006600",
                "comm_mdp": "testmdpcomedit"
            }'
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
            '/PFR-MADERA/commercial',
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
        $this->assertSame("nomtestcomedit",$responseData["pers_nom"]);
        $this->assertSame("pretestcomedit",$responseData["pers_prenom"]);
        $this->assertSame("mailtestedit@commercial.com",$responseData["pers_mail"]);
        $this->assertSame("0000006600",$responseData["pers_tel"]);
        $this->assertSame("testmdpcomedit",$responseData["comm_mdp"]);

        //Vérification de la suppression
        print_r("D");
        $client = static::createClient();
        $crawler = $client->request(
            'DELETE',
            '/PFR-MADERA/commercial',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"comm_id": '.$testid.'}'
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
        $crawler = $client->request('GET', '/PFR-MADERA/commercials');
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());//test route
        $responseData = json_decode($response->getContent(), true);
    }
}