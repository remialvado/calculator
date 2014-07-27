<?php

namespace Acme\CalculatorBundle\Service;

use Acme\CalculatorBundle\Model\Operator;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.operator.factory")
 */
class OperatorFactory
{
    /**
     * @var \Acme\CalculatorBundle\Model\Operator[]
     */
    protected $operators;

    function __construct($operators = null)
    {
        if (!isset($operators)) {
            $operators = [
                "add"       => new Operator("add", "+"),
                "substract" => new Operator("substract", "-"),
                "multiply"  => new Operator("multiply", "*"),
                "divide"    => new Operator("divide", "/"),
            ];
        }
        $this->operators = $operators;
    }

    /**
     * @param string $id
     * @return Operator
     */
    public function getOperator($id)
    {
        if (array_key_exists($id, $this->operators)) {
            return  $this->operators[$id];
        }
        throw new \Exception("Do not support operator '" . $id . "' for the moment");
    }

    /**
     * @return \Acme\CalculatorBundle\Model\Operator[]
     */
    public function getSupportedOperators()
    {
        return array_values($this->operators);
    }
} 