<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Usuario1ControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tienda/crear');
    }

    public function testEncontrar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tienda/encontrar');
    }

}
