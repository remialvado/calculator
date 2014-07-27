<?php

namespace Acme\CalculatorBundle\Controller;

use Acme\CalculatorBundle\Model\Operand;
use Acme\CalculatorBundle\Model\Operator;
use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.controller")
 */
class DefaultController extends AbstractController
{
    public function homepage()
    {
        return $this->render('AcmeCalculatorBundle:Default:index.html.twig', [
            "operators" => $this->operatorFactory->getSupportedOperators()
        ]);
    }

    public function compute(Request $request)
    {
        $operandA = new Operand($request->get("operand-a"));
        $operandB = new Operand($request->get("operand-b"));
        $operator = $this->operatorFactory->getOperator($request->get("operator"));
        return $this->render('AcmeCalculatorBundle:Default:result.html.twig', [
            "operandA" => $operandA,
            "operandB" => $operandB,
            "operator" => $operator,
            "result"   => $this->calculator->compute($operandA, $operandB, $operator),
        ]);
    }

    /**
     * @var \Acme\CalculatorBundle\Service\Calculator
     * @DI\Inject("acme.calculator.calculator.simple")
     */
    public $calculator;

    /**
     * @var \Acme\CalculatorBundle\Service\OperatorFactory
     * @DI\Inject("acme.calculator.operator.factory")
     */
    public $operatorFactory;

    /**
     * @DI\Inject("templating")
     */
    public $templating;
}
