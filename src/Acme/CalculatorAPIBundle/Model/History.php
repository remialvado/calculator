<?php

namespace Acme\CalculatorAPIBundle\Model;

use JMS\Serializer\Annotation as Serializer;

class History implements \IteratorAggregate, \Countable
{
    /**
     * @var HistoryItem[]
     * @Serializer\Type("array<Acme\CalculatorAPIBundle\Model\HistoryItem>")
     */
    protected $historyItems;

    public function __construct($historyItems = [])
    {
        $this->historyItems = $historyItems;
    }

    public function add($historyItem)
    {
        array_unshift($this->historyItems, $historyItem);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->historyItems);
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        return is_array($this->historyItems) ? count($this->historyItems) : 0;
    }
} 