<?php

namespace Acme\CalculatorBundle\Tests\Model\Operator;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Tests\BaseTestCase;
use Acme\CalculatorBundle\Model\Operator\Divide;

class DivideTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $divide = new Divide();
        $this->assertThat($divide->getId(), $this->equalTo("divide"));
        $this->assertThat($divide->getLabel(), $this->equalTo("/"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(10), new Operand(2)), $this->equalTo(new Result(5)));
    }

    /**
     * @test
     */
    public function dividePositiveByZero()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(10), new Operand(0)), $this->equalTo(new Result("infinity")));
    }

    /**
     * @test
     */
    public function divideNegativeByZero()
    {
        $divide = new Divide();
        $this->assertThat($divide->compute(new Operand(-10), new Operand(0)), $this->equalTo(new Result("-infinity")));
    }
} 