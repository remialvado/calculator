<?php

namespace Acme\CalculatorBundle\Tests\Model;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Operator\Add;
use Acme\CalculatorBundle\Model\Operator\Divide;
use Acme\CalculatorBundle\Model\Operator\Multiply;
use Acme\CalculatorBundle\Model\Operator\Operator;
use Acme\CalculatorBundle\Model\Operator\Substract;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Service\Calculator;
use Acme\CalculatorBundle\Tests\BaseTestCase;

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
        $mockOperator = $this->getMock("Acme\CalculatorBundle\Tests\Model\BaseOperator");
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
        $mockOperator = $this->getMockBuilder("Acme\CalculatorBundle\Tests\Model\BaseOperator")
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
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @return \Acme\CalculatorBundle\Model\Result mixed
     */
    public function compute($operandA, $operandB)
    {
        return new Result(0);
    }

    public function __construct(){}

}