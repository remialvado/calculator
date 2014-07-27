<?php

namespace Acme\CalculatorAPIBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.calculator.simple")
 */
class Calculator
{
    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     * @param \Acme\CalculatorAPIBundle\Model\Operator\Operator $operator
     * @return \Acme\CalculatorAPIBundle\Model\Result
     */
    public function compute($operandA, $operandB, $operator)
    {
        return $operator->compute($operandA, $operandB);
    }
} 