<?php

namespace Acme\CalculatorBundle\Tests\Model;

use Acme\CalculatorBundle\Model\Operator;

class OperatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $operator = new Operator("+", "add");
        $this->assertThat($operator->getId(), $this->equalTo("+"));
        $this->assertThat($operator->getLabel(), $this->equalTo("add"));
    }

    /**
     * @test
     */
    public function setId()
    {
        $operator = new Operator("+", "add");
        $operator->setId("-");
        $this->assertThat($operator->getId(), $this->equalTo("-"));
    }

    /**
     * @test
     */
    public function setLabel()
    {
        $operator = new Operator("+", "add");
        $operator->setLabel("substract");
        $this->assertThat($operator->getLabel(), $this->equalTo("substract"));
    }
} 