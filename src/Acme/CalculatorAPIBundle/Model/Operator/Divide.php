<?php

namespace Acme\CalculatorAPIBundle\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Result;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.divide")
 * @DI\Tag("acme.calculator.operator")
 */
class Divide extends Operator
{
    public function __construct()
    {
        parent::__construct("divide", "/");
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     * @return \Acme\CalculatorAPIBundle\Model\Result
     */
    public function compute($operandA, $operandB)
    {
        if ($operandB->getValue() == 0 && $operandA->getValue() > 0) {
            return new Result("infinity");
        }
        else if ($operandB->getValue() == 0) {
            return new Result("-infinity");
        }
        return new Result($operandA->getValue() / $operandB->getValue());
    }
} 