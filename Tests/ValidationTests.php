<?php

namespace Bundle\Sensio\CasBundle\Tests\CasBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ValidationTest extends WebTestCase
{
    public function testSuccess()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/cas/protected?ticket=success');
        $this->assertEquals('access granted', $crawler->text());
    }

    public function testError()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/cas/protected?ticket=error');
        $this->assertTrue($client->getResponse()->isRedirection());
    }
}