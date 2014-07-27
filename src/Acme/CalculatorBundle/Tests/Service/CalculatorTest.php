<?php

namespace Acme\CalculatorBundle\Tests\Model;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Operator;
use Acme\CalculatorBundle\Model\Result;
use Acme\CalculatorBundle\Service\Calculator;
use Acme\CalculatorBundle\Tests\BaseTestCase;

class CalculatorTest extends BaseTestCase {

    /**
     * @test
     * @dataProvider getSupportedOperators
     */
    public function computeOnSupportedOperator($operandA, $operandB, $operator, $result)
    {
        $calculator = new Calculator();
        $this->assertThat($calculator->compute($operandA, $operandB, $operator), $this->equalTo($result));
    }

    /**
     * @test
     * @expectedException \Exception
     */
    public function computeOnNotSupportedOperator()
    {
        $calculator = new Calculator();
        $calculator->compute(new Operand(10), new Operand(2), new Operator("modulo", "%"));
    }

    public function getSupportedOperators()
    {
        return [
            [new Operand(10), new Operand(2), new Operator("add", "+"), new Result(12)],
            [new Operand(10), new Operand(2), new Operator("substract", "-"), new Result(8)],
            [new Operand(10), new Operand(2), new Operator("multiply", "*"), new Result(20)],
            [new Operand(10), new Operand(2), new Operator("divide", "/"), new Result(5)],
        ];
    }
} 