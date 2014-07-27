<?php

namespace Acme\CalculatorAPIBundle\Controller;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Operation;
use Acme\CalculatorAPIBundle\Model\Operator;
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
        $operation = new Operation($operandA, $operandB, $operator, $result);
        return new Response($this->serializer->serialize($operation, $_format));
    }

    /**
     * @var \Acme\CalculatorAPIBundle\Service\Calculator
     * @DI\Inject("acme.calculator.calculator.simple")
     */
    public $calculator;

    /**
     * @var \Acme\CalculatorAPIBundle\Service\OperatorFactory
     * @DI\Inject("acme.calculator.operator.factory")
     */
    public $operatorFactory;

    /**
     * @var \JMS\Serializer\SerializerInterface
     * @DI\Inject("serializer")
     */
    public $serializer;
}
