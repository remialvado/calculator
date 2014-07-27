<?php

namespace Acme\CalculatorBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.calculator.simple")
 */
class Calculator
{
    /**
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @param \Acme\CalculatorBundle\Model\Operator\Operator $operator
     * @return \Acme\CalculatorBundle\Model\Result
     */
    public function compute($operandA, $operandB, $operator)
    {
        return $operator->compute($operandA, $operandB);
    }
} 