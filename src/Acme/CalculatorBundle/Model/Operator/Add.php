<?php

namespace Acme\CalculatorBundle\Model\Operator;

use Acme\CalculatorBundle\Model\Result;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.add")
 * @DI\Tag("acme.calculator.operator")
 */
class Add extends Operator
{
    public function __construct()
    {
        parent::__construct("add", "+");
    }

    /**
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @return \Acme\CalculatorBundle\Model\Result|void
     */
    public function compute($operandA, $operandB)
    {
        return new Result($operandA->getValue() + $operandB->getValue());
    }
} 