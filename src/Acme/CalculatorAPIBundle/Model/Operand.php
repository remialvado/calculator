<?php

namespace Acme\CalculatorAPIBundle\Model;

class Operand
{
    /**
     * @var float
     */
    protected $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inherit
     */
    public function __toString()
    {
        return (string) $this->value;
    }
} 