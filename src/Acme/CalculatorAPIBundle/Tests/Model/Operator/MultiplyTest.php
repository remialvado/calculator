<?php

namespace Acme\CalculatorAPIBundle\Tests\Model\Operator;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Result;
use Acme\CalculatorAPIBundle\Tests\BaseTestCase;
use Acme\CalculatorAPIBundle\Model\Operator\Multiply;

class MultiplyTest extends BaseTestCase
{
    /**
     * @test
     */
    public function constructor()
    {
        $multiply = new Multiply();
        $this->assertThat($multiply->getId(), $this->equalTo("multiply"));
        $this->assertThat($multiply->getLabel(), $this->equalTo("*"));
    }

    /**
     * @test
     */
    public function compute()
    {
        $multiply = new Multiply();
        $this->assertThat($multiply->compute(new Operand(3), new Operand(2)), $this->equalTo(new Result(6)));
    }

    /**
     * @test
     */
    public function serializeJson() {
        $multiply = new Multiply();
        $expected = '{"_type":"multiply","id":"multiply","label":"*"}';
        $this->assertThat($this->getSerializer()->serialize($multiply, "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function deserializeJson() {
        $actual = '{"_type":"multiply","id":"multiply","label":"*"}';
        $expected = new Multiply();
        $this->assertThat($this->getSerializer()->deserialize($actual, "Acme\CalculatorAPIBundle\Model\Operator\Operator", "json"), $this->equalTo($expected));
    }

    /**
     * @test
     */
    public function serializeXml() {
        $multiply = new Multiply();
        $this->assertThat($this->getSerializer()->serialize($multiply, "xml"), $this->equalTo($this->xmlSerializationFormat));
    }

    /**
     * @test
     */
    public function deserializeXml() {
        $expected = new Multiply();
        $this->assertThat($this->getSerializer()->deserialize($this->xmlSerializationFormat, "Acme\CalculatorAPIBundle\Model\Operator\Operator", "xml"), $this->equalTo($expected));
    }

    /**
     * @return \JMS\Serializer\SerializerInterface
     */
    protected function getSerializer()
    {
        return $this->getService("serializer");
    }

    protected $xmlSerializationFormat = <<<'EOD'
<?xml version="1.0" encoding="UTF-8"?>
<result>
  <_type><![CDATA[multiply]]></_type>
  <id><![CDATA[multiply]]></id>
  <label><![CDATA[*]]></label>
  <_type><![CDATA[multiply]]></_type>
</result>

EOD;
} 