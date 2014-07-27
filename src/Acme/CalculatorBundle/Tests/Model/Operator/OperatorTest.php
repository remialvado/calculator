<?php

namespace Acme\CalculatorBundle\Tests\Model\Operator;

use Acme\CalculatorBundle\Model\Operator\Operator;
use Acme\CalculatorBundle\Model\Result;

class OperatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $operator = new BaseOperator("add", "+");
        $this->assertThat($operator->getId(), $this->equalTo("add"));
        $this->assertThat($operator->getLabel(), $this->equalTo("+"));
    }

    /**
     * @test
     */
    public function setId()
    {
        $operator = new BaseOperator("add", "+");
        $operator->setId("substract");
        $this->assertThat($operator->getId(), $this->equalTo("substract"));
    }

    /**
     * @test
     */
    public function setLabel()
    {
        $operator = new BaseOperator("add", "+");
        $operator->setLabel("-");
        $this->assertThat($operator->getLabel(), $this->equalTo("-"));
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

}