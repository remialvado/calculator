<?php

namespace Acme\CalculatorBundle\Tests\Model\Operator;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Operator\Add;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Tests\BaseTestCase;

class AddTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $add = new Add();
        $this->assertThat($add->getId(), $this->equalTo("add"));
        $this->assertThat($add->getLabel(), $this->equalTo("+"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $add = new Add();
        $this->assertThat($add->compute(new Operand(1), new Operand(2)), $this->equalTo(new Result(3)));
    }
} 