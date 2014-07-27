<?php

namespace Acme\CalculatorAPIBundle\Controller;

use Acme\CalculatorAPIBundle\Model\Operand;
use Acme\CalculatorAPIBundle\Model\Operator;
use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Response;

/**
 * @DI\Service("acme.calculator.api.controller")
 */
class DefaultController extends AbstractController
{
    public function computeJson(Request $request)
    {
        $operandA = new Operand($request->get("operandA"));
        $operandB = new Operand($request->get("operandB"));
        $operator = $this->operatorFactory->getOperator($request->get("operator"));

        $result = $this->calculator->compute($operandA, $operandB, $operator);
        return new Response(json_encode([
            "operandA" => $operandA->getValue(),
            "operandB" => $operandB->getValue(),
            "operator" => [
                "id"    => $operator->getId(),
                "label" => $operator->getLabel(),
            ],
            "result" => $result->getValue()
        ]));
    }

    public function computeXml(Request $request)
    {
        $operandA = new Operand($request->get("operandA"));
        $operandB = new Operand($request->get("operandB"));
        $operator = $this->operatorFactory->getOperator($request->get("operator"));

        $result = $this->calculator->compute($operandA, $operandB, $operator);
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><operation></operation>");
        $xml->addChild("operandA", $operandA->getValue());
        $xml->addChild("operandB", $operandB->getValue());
        $operatorXml = $xml->addChild("operator");
        $operatorXml->addAttribute("id", $operator->getId());
        $operatorXml->addAttribute("label", $operator->getLabel());
        $xml->addChild("result", $result->getValue());

        return new Response($xml->asXML());
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
}
