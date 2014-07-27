<?php

namespace Acme\CalculatorAPIBundle\Tests\Model;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Operator\Add;
use Acme\CalculatorAPIBundle\Model\Operator\Divide;
use Acme\CalculatorAPIBundle\Model\Operator\Multiply;
use Acme\CalculatorAPIBundle\Model\Operator\Operator;
use Acme\CalculatorAPIBundle\Model\Operator\Substract;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Service\Calculator;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;

class CalculatorTest extends BaseTestCase
{

    /**
     * @test
     * @dataProvider getSupportedOperators
     */
    public function computeWithoutMocks($operandA, $operandB, $operator, $result)
    {
        $calculator = new Calculator();
        $this->assertThat($calculator->compute($operandA, $operandB, $operator), $this->equalTo($result));
    }

    /**
     * @test
     */
    public function computeWithMock()
    {
        $calculator = new Calculator();
        $mockOperator = $this->getMock("Acme\CalculatorAPIBundle\Tests\Model\BaseOperator");
        $mockOperator->expects($this->once())
                     ->method("compute")
                     ->with($this->equalTo(new Operand(10)), $this->equalTo(new Operand(5)));
        $calculator->compute(new Operand(10), new Operand(5), $mockOperator);
    }

    /**
     * @test
     */
    public function computeWithMockBuilder()
    {
        $calculator = new Calculator();
        $mockOperator = $this->getMockBuilder("Acme\CalculatorAPIBundle\Tests\Model\BaseOperator")
                             ->setMethods(["compute"])
                             ->disableOriginalConstructor()
                             ->getMock();
        $mockOperator->expects($this->once())
                     ->method("compute")
                     ->with($this->equalTo(new Operand(10)), $this->equalTo(new Operand(5)));
        $calculator->compute(new Operand(10), new Operand(5), $mockOperator);
    }

    public function getSupportedOperators()
    {
        return [
            [new Operand(10), new Operand(2), new Add(), new Result(12)],
            [new Operand(10), new Operand(2), new Substract(), new Result(8)],
            [new Operand(10), new Operand(2), new Multiply(), new Result(20)],
            [new Operand(10), new Operand(2), new Divide(), new Result(5)],
        ];
    }
}

class BaseOperator extends Operator
{
    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     * @return \Acme\CalculatorAPIBundle\Model\Result mixed
     */
    public function compute($operandA, $operandB)
    {
        return new Result(0);
    }

    public function __construct(){}

}