<?php

namespace Acme\CalculatorBundle\Model\Operator;

abstract class Operator
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $label;

    function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }

    /**
     * @param \Acme\CalculatorBundle\Model\Operand $operandA
     * @param \Acme\CalculatorBundle\Model\Operand $operandB
     * @return \Acme\CalculatorBundle\Model\Result mixed
     */
    public abstract function compute($operandA, $operandB);

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
} 