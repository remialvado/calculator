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
    public function compute(Request $request, $_format = "json")
    {
        $operandA = new Operand($request->get("operandA"));
        $operandB = new Operand($request->get("operandB"));
        $operator = $this->operatorFactory->getOperator($request->get("operator"));

        $result = $this->calculator->compute($operandA, $operandB, $operator);
        return new Response($this->serializer->serialize($result, $_format));
    }

    /**
     * @var \Acme\CalculatorAPIBundle\Service\Calculator
     * @DI\Inject("acme.calculator.calculator.simple")
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
}
