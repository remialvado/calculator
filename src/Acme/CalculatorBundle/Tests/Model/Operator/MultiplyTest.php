<?php

namespace Acme\CalculatorBundle\Tests\Model\Operator;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Tests\BaseTestCase;
use Acme\CalculatorBundle\Model\Operator\Multiply;

class MultiplyTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $multiply = new Multiply();
        $this->assertThat($multiply->getId(), $this->equalTo("multiply"));
        $this->assertThat($multiply->getLabel(), $this->equalTo("*"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $multiply = new Multiply();
        $this->assertThat($multiply->compute(new Operand(3), new Operand(2)), $this->equalTo(new Result(6)));
    }
} 