<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CycleControllerTest extends WebTestCase
{
    public function testNewcycle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/newCycle');
    }

}
