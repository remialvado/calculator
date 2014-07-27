<?php

namespace Acme\CalculatorAPIBundle\Tests\Model;

use Acme\CalculatorAPIBundle\Model\Operator\Add;
use Acme\CalculatorAPIBundle\Service\OperatorFactory;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;

class OperatorFactoryTest extends BaseTestCase
{
    /**
     * @test
     */
    public function getExistingOperator()
    {
        $addOperator = new Add();
        $operatorFactory = new OperatorFactory(["add" => $addOperator]);
        $this->assertThat($operatorFactory->getOperator("add"), $this->equalTo($addOperator));
    }

    /**
     * @test
     */
    public function getNonExistingOperator()
    {
        $addOperator = new Add();
        $operatorFactory = new OperatorFactory(["add" => $addOperator]);
        try {
            $operatorFactory->getOperator("substract");
            $this->fail("Should throw an exception when an operator is not supported !");
        }
        catch(\Exception $e) {}
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function getNonExistingOperatorWithAnnotation()
    {
        $addOperator = new Add();
        $operatorFactory = new OperatorFactory(["add" => $addOperator]);
        $operatorFactory->getOperator("substract");
    }

    /**
     * @test
     */
    public function getSupportedOperators()
    {
        $operatorFactory = $this->getService("acme.calculator.operator.factory");
        $supportedOperators = $operatorFactory->getSupportedOperators();
        foreach($supportedOperators as $supportedOperator) {
            $this->assertThat($supportedOperator, $this->isInstanceOf("Acme\CalculatorAPIBundle\Model\Operator\Operator"));
        }
    }
} 