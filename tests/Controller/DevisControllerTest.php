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
            '{
                "mais_id": 1,
                "gamm_id": 1,
                "comm_id": 1,
                "clie_id": 1,
                "devi_nom": "testdevis",
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
                "adre_info": "adreinfotest"
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
            '/PFR-MADERA/devis/'.$testid.'',
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
        $this->assertSame("testdevis",$responseData["devi_nom"]);
        $this->assertSame("adretest",$responseData["adre_region"]);
        $this->assertSame("adrecomtest",$responseData["adre_complement"]);

        //Modification du commercial
        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/PFR-MADERA/devis/'.$testid.'',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{
                "mais_id": 1,
                "gamm_id": 1,
                "comm_id": 1,
                "clie_id": 1,
                "devi_nom": "devis2",
                "devi_date": {
                    "date": "2019-12-24 00:00:00.000000",
                    "timezone_type": 3,
                    "timezone": "Europe/Berlin"
                },
                "pays_id": 1,
                "adre_region": "adretest2",
                "adre_ville": "villetest",
                "adre_cp": "11111",
                "adre_rue": "ruetest",
                "adre_complement": "adrecomtest2",
                "adre_info": "adreinfotest"
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
            '/PFR-MADERA/devis/'.$testid.'',
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
        $this->assertSame("devis2",$responseData["devi_nom"]);
        $this->assertSame("adretest2",$responseData["adre_region"]);
        $this->assertSame("adrecomtest2",$responseData["adre_complement"]);

        //Vérification de la suppression
        $client = static::createClient();
        $crawler = $client->request(
            'DELETE',
            '/PFR-MADERA/devis/'.$testid.'',
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