<?php

namespace Acme\CalculatorAPIBundle\Service;

use Acme\CalculatorModelBundle\Model\Operation;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.calculator.cache")
 */
class CacheCalculator
{
    const FORMAT = "json";
    const LIFETIME = 60;

    /**
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandA
     * @param \Acme\CalculatorModelBundle\Model\Operand $operandB
     * @param \Acme\CalculatorModelBundle\Model\Operator\Operator $operator
     * @return \Acme\CalculatorModelBundle\Model\Result
     */
    public function compute($operandA, $operandB, $operator)
    {
        $key = "compute-" . $operandA->getValue() . $operator->getLabel() . $operandB->getValue();
        $content = $this->cache->fetch($key);
        if ($content === FALSE) {
            $result = $operator->compute($operandA, $operandB);
            $this->cache->save($key, $this->serializer->serialize($result, self::FORMAT), self::LIFETIME);
            $this->historyManager->add("operator", new Operation($operandA, $operandB, $operator, $result), new \DateTime(), $this->requestStack->getMasterRequest()->headers->get('User-Agent'));
        }
        else {
            $result = $this->serializer->deserialize($content, "Acme\CalculatorModelBundle\Model\Result", self::FORMAT);
            $this->historyManager->add("business-cache", new Operation($operandA, $operandB, $operator, $result), new \DateTime(), $this->requestStack->getMasterRequest()->headers->get('User-Agent'));
        }

        return $result;
    }

    /**
     * @var HistoryManager
     * @DI\Inject("acme.calculator.api.history")
     */
    public $historyManager;

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack
     * @DI\Inject("request_stack")
     */
    public $requestStack;

    /**
     * @DI\Inject("acme.cache.apc")
     * @var \Doctrine\Common\Cache\Cache
     */
    public $cache;

    /**
     * @var \JMS\Serializer\SerializerInterface
     * @DI\Inject("serializer")
     */
    public $serializer;
} 