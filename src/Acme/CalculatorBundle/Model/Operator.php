<?php

namespace Acme\CalculatorBundle\Model;

class Operator
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