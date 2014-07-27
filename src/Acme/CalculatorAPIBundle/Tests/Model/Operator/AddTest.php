<?php

namespace Acme\CalculatorAPIBundle\Tests\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Operator\Add;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;

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