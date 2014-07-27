<?php

namespace Acme\CalculatorAPIBundle\Tests\Model;

use Acme\CalculatorAPIBundle\Model\Operand;

class OperandTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $operand = new Operand(3);
        $this->assertThat($operand->getValue(), $this->equalTo(3));
    }

    /**
     * @test
     */
    public function setValue()
    {
        $operand = new Operand(3);
        $operand->setValue(4);
        $this->assertThat($operand->getValue(), $this->equalTo(4));
    }
} 