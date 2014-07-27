<?php

namespace Acme\CalculatorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/compute?operand-a=2&operator=add&operand-b=0');

        $this->assertTrue($crawler->filter('html:contains("2")')->count() > 0);
    }
}
