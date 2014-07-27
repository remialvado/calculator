<?php

namespace Acme\CalculatorUIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @DI\Service("acme.calculator.ui.controller")
 */
class DefaultController extends AbstractController
{
    /**
     * @Template("AcmeCalculatorUIBundle:Default:homepage.html.twig")
     */
    public function homepage(Request $request)
    {
        return [];
    }

    /**
     * @Template("AcmeCalculatorUIBundle:Default:result.html.twig")
     */
    public function compute(Request $request)
    {

        $operandA = $request->get("operand-a");
        $operandB = $request->get("operand-b");
        $operator = $request->get("operator");

        $operation = $this->calculatorServiceClient->compute($operandA, $operandB, $operator);

        return ["operation" => $operation];
    }

    /**
     * @var \Acme\CalculatorModelBundle\Service\CalculatorServiceClient
     * @DI\Inject("acme.calculator.model.service.client")
     */
    public $calculatorServiceClient;

    /**
     * @var \Acme\CalculatorModelBundle\Service\OperatorFactory
     * @DI\Inject("acme.calculator.operator.factory")
     */
    public $operatorFactory;

    /**
     * @DI\Inject("templating")
     */
    public $templating;
}
