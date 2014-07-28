<?php

namespace Acme\CalculatorAPIBundle\Controller;

use Acme\CalculatorModelBundle\Model\Operand;
use Acme\CalculatorModelBundle\Model\Operator;
use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;

/**
 * @DI\Service("acme.calculator.api.controller")
 */
class DefaultController extends AbstractController
{
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function compute(Request $request, $_format = "json")
    {
        $operandA = new Operand($request->get("operandA"));
        $operandB = new Operand($request->get("operandB"));
        $operator = $this->operatorFactory->getOperator($request->get("operator"));

        $result = $this->calculator->compute($operandA, $operandB, $operator);
        $response = new Response($this->serializer->serialize($result, $_format));
        $date = $this->date;
        $date->modify('+10 seconds');
        $response->setExpires($date);
        $response->setCache(["public" => "true"]);
        return $response;
    }

    public function history(Request $request, $_format = "json")
    {
        return new Response($this->serializer->serialize($this->historyManager->getHistory(), $_format));
    }

    public function historyPurge(Request $request, $_format = "json")
    {
        $this->historyManager->purge();
        return new Response(null, 204);
    }

    /**
     * @var \Acme\CalculatorAPIBundle\Service\HistoryManager
     * @DI\Inject("acme.calculator.api.history")
     */
    public $historyManager;

    /**
     * @var \Acme\CalculatorAPIBundle\Service\CacheCalculator
     * @DI\Inject("acme.calculator.calculator.cache")
     */
    public $calculator;

    /**
     * @var \Acme\CalculatorModelBundle\Service\OperatorFactory
     * @DI\Inject("acme.calculator.operator.factory")
     */
    public $operatorFactory;

    /**
     * @var \JMS\Serializer\SerializerInterface
     * @DI\Inject("serializer")
     */
    public $serializer;

    /**
     * @var \DateTime
     */
    public $date;
}
