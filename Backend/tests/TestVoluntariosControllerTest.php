<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestVoluntariosControllerTest extends WebTestCase
{
    public function testResponseIsJson(): void
    {
        $client = static::createClient();
        $client->request('GET', '/voluntarios/apis');

        $response = $client->getResponse();
        
        $this->assertTrue($response->isSuccessful());
        $this->assertJson($response->getContent());
    }
}
