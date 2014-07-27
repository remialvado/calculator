<?php

namespace Acme\CalculatorBundle\Model\Operator;

use Acme\CalculatorBundle\Model\Result;
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
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @return \Acme\CalculatorBundle\Model\Result|void
     */
    public function compute($operandA, $operandB)
    {
        if ($operandB->getValue() === 0 && $operandA->getValue() > 0) {
            return "infinity";
        }
        else if ($operandB->getValue() === 0) {
            return "-infinity";
        }
        return new Result($operandA->getValue() / $operandB->getValue());
    }
} 