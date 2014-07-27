<?php

namespace Acme\CalculatorBundle\Tests\Model\Operator;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Operator\Substract;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Tests\BaseTestCase;

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