<?php

namespace Acme\CalculatorAPIBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.calculator.simple")
 */
class Calculator
{
    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @param \Acme\CalculatorModelBundle\Model\Operator\Operator $operator
     * @return \Acme\CalculatorModelBundle\Model\Result
     */
    public function compute($operandA, $operandB, $operator)
    {
        return $operator->compute($operandA, $operandB);
    }
} 