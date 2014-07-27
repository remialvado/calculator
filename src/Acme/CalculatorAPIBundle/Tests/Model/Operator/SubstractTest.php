<?php

namespace Acme\CalculatorAPIBundle\Tests\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Operator\Substract;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;

class SubstractTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $substract = new Substract();
        $this->assertThat($substract->getId(), $this->equalTo("substract"));
        $this->assertThat($substract->getLabel(), $this->equalTo("-"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $substract = new Substract();
        $this->assertThat($substract->compute(new Operand(2), new Operand(1)), $this->equalTo(new Result(1)));
    }
} 