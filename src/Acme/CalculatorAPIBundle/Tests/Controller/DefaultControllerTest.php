<?php

namespace Acme\CalculatorAPIBundle\Tests\Controller;

use Acme\CalculatorAPIBundle\Controller\DefaultController;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;
use Symfony\Component\HttpFoundation\Request;

class DefaultControllerTest extends BaseTestCase
{
    public function testComputeJson()
    {
        $request    = Request::create("", "GET", ["operandA" => 4, "operandB" => 7, "operator" => "add"]);
        $controller = new DefaultController();
        $controller->operatorFactory = $this->getService("acme.calculator.operator.factory");
        $controller->calculator = $this->getService("acme.calculator.calculator.simple");
        $response = $controller->computeJson($request);
        $result = json_decode($response->getContent(), true);

        $this->assertTrue(is_array($result));
        $this->assertThat($result["operandA"], $this->equalTo("4"));
        $this->assertThat($result["operandB"], $this->equalTo("7"));
        $this->assertThat($result["operator"]["id"], $this->equalTo("add"));
        $this->assertThat($result["operator"]["label"], $this->equalTo("+"));
        $this->assertThat($result["result"], $this->equalTo("11"));
    }
}
