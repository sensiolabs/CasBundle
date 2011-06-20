<?php

namespace Sensio\CasBundle\Tests\CasBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BasicTest extends WebTestCase
{
    public function testService()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/cas/service');
        $this->assertEquals('Sensio\\CasBundle\\Service\\Cas', $crawler->text());
    }

    public function testProtected()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/cas/protected');
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}