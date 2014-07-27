<?php

namespace Acme\CalculatorBundle\Tests\Model;

use Acme\CalculatorBundle\Model\Result;

class ResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $result = new Result(3);
        $this->assertThat($result->getValue(), $this->equalTo(3));
    }

    /**
     * @test
     */
    public function setValue()
    {
        $result = new Result(3);
        $result->setValue(4);
        $this->assertThat($result->getValue(), $this->equalTo(4));
    }
} 