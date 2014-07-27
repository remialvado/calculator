<?php

namespace Acme\CalculatorAPIBundle\Tests\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Operator\Operator;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;

class OperatorTest extends BaseTestCase
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
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     * @return \Acme\CalculatorAPIBundle\Model\Result mixed
     */
    public function compute($operandA, $operandB)
    {
        return new Result(0);
    }

}