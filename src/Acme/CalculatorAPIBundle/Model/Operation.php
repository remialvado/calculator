<?php

namespace Acme\CalculatorAPIBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class Operation
{
    /**
     * @var \Acme\CalculatorAPIBundle\Model\Operand
     * @Serializer\Type("Acme\CalculatorAPIBundle\Model\Operand")
     */
    protected $operandA;

    /**
     * @var \Acme\CalculatorAPIBundle\Model\Operand
     * @Serializer\Type("Acme\CalculatorAPIBundle\Model\Operand")
     */
    protected $operandB;

    /**
     * @var \Acme\CalculatorAPIBundle\Model\Operator\Operator
     * @Serializer\Type("Acme\CalculatorAPIBundle\Model\Operator\Operator")
     */
    protected $operator;

    /**
     * @var \Acme\CalculatorAPIBundle\Model\Result
     * @Serializer\Type("Acme\CalculatorAPIBundle\Model\Result")
     */
    protected $result;

    function __construct($operandA, $operandB, $operator, $result)
    {
        $this->operandA = $operandA;
        $this->operandB = $operandB;
        $this->operator = $operator;
        $this->result = $result;
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandA
     */
    public function setOperandA($operandA)
    {
        $this->operandA = $operandA;
    }

    /**
     * @return \Acme\CalculatorAPIBundle\Model\Operand
     */
    public function getOperandA()
    {
        return $this->operandA;
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operand $operandB
     */
    public function setOperandB($operandB)
    {
        $this->operandB = $operandB;
    }

    /**
     * @return \Acme\CalculatorAPIBundle\Model\Operand
     */
    public function getOperandB()
    {
        return $this->operandB;
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Operator\Operator $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }

    /**
     * @return \Acme\CalculatorAPIBundle\Model\Operator\Operator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @param \Acme\CalculatorAPIBundle\Model\Result $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return \Acme\CalculatorAPIBundle\Model\Result
     */
    public function getResult()
    {
        return $this->result;
    }
} 