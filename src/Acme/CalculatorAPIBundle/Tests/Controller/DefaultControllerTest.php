<?php

namespace Acme\CalculatorAPIBundle\Tests\Controller;

use Acme\CalculatorAPIBundle\Controller\DefaultController;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends BaseTestCase
{
    public function testCompute()
    {
        $request    = Request::create("add.json", "GET", ["operandA" => 4, "operandB" => 7, "operator" => "add"]);
        $controller = new DefaultController();
        $controller->operatorFactory = $this->getService("acme.calculator.operator.factory");
        $controller->calculator = $this->getService("acme.calculator.calculator.simple");
        $controller->serializer = $this->getService("serializer");
        $response = $controller->compute($request);
        $result = json_decode($response->getContent(), true);

        $this->assertTrue(is_array($result));
        $this->assertThat($result["value"], $this->equalTo("11"));
    }
}
