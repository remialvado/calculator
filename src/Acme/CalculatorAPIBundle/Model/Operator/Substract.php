<?php

namespace Acme\CalculatorAPIBundle\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Result;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.substract")
 * @DI\Tag("acme.calculator.operator")
 */
class Substract extends Operator
{
    public function __construct()
    {
        parent::__construct("substract", "-");
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     * @return \Acme\CalculatorAPIBundle\Model\Result|void
     */
    public function compute($operandA, $operandB)
    {
        return new Result($operandA->getValue() - $operandB->getValue());
    }
} 