<?php

namespace Acme\CalculatorAPIBundle\Tests\Controller;

use Acme\CalculatorAPIBundle\Controller\DefaultController;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends BaseTestCase
{
    protected $apiController;

    protected function setUp()
    {
        parent::setUp();
        $this->apiController = new DefaultController();
        $this->apiController->operatorFactory = $this->getService("acme.calculator.operator.factory");
        $this->apiController->calculator = $this->getService("acme.calculator.calculator.simple");
        $this->apiController->serializer = $this->getService("serializer");
        $this->apiController->date = new \DateTime("2014-07-28T16:00:00+00:00");
    }

    /**
     * @test
     */
    public function results()
    {
        $request = Request::create("add.json", "GET", ["operandA" => 4, "operandB" => 7, "operator" => "add"]);
        $response = $this->apiController->compute($request);
        $result = json_decode($response->getContent(), true);

        $this->assertTrue(is_array($result));
        $this->assertThat($result["value"], $this->equalTo("11"));
        return $response;
    }

    /**
     * @test
     * @depends results
     * @var \Symfony\Component\HttpFoundation\Response
     */
    public function expires($response)
    {
        $expected = "2014-07-28 16:00:10";
        $this->assertThat($response->getExpires()->format("Y-m-d H:i:s"), $this->equalTo($expected));
    }
}
