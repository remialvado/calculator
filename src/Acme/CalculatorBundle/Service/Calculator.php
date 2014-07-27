<?php

namespace Acme\CalculatorBundle\Service;

use Acme\CalculatorBundle\Model\Result;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.calculator.simple")
 */
class Calculator
{
    /**
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @param \Acme\CalculatorBundle\Model\Operator $operator
     * @return Result
     * @throws \Exception
     */
    public function compute($operandA, $operandB, $operator)
    {
        if ($operator->getId() === "add")       return new Result($operandA->getValue() + $operandB->getValue());
        if ($operator->getId() === "substract") return new Result($operandA->getValue() - $operandB->getValue());
        if ($operator->getId() === "multiply")  return new Result($operandA->getValue() * $operandB->getValue());
        if ($operator->getId() === "divide")    return new Result($operandA->getValue() / $operandB->getValue());
        throw new \Exception("Do not support operator '" . $operator->getId() . "' for the moment");
    }
} 