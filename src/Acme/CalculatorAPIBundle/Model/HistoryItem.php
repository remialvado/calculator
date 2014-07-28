<?php

namespace Acme\CalculatorAPIBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class HistoryItem
{
    /**
     * @var \DateTime
     * @Serializer\Type("DateTime")
     */
    protected $date;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type;

    /**
     * @var \Acme\CalculatorModelBundle\Model\Operation
     * @Serializer\Type("Acme\CalculatorModelBundle\Model\Operation")
     */
    protected $operation;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $userAgent;

    function __construct($date, $type, $operation, $userAgent)
    {
        $this->date = $date;
        $this->type = $type;
        $this->operation = $operation;
        $this->userAgent = $userAgent;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operation $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return \Acme\CalculatorModelBundle\Model\Operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }
} 