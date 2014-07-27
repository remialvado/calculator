<?php

namespace Acme\CalculatorAPIBundle\Model;


class Result
{
    /**
     * @var mixed
     */
    protected $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
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