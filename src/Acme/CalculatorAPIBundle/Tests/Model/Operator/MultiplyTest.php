<?php

namespace Acme\CalculatorAPIBundle\Tests\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;
use Acme\CalculatorAPIBundle\Model\Operator\Multiply;

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