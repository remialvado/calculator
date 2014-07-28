<?php

namespace Acme\CalculatorUIBundle\Controller;

use Acme\CalculatorModelBundle\Model\Operation;
use Acme\CalculatorUIBundle\Type\OperationType;
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
        $operation = new Operation();
        $form = $this->formFactory->create("operation", $operation);
        return ["form" => $form->createView()];
    }

    /**
     * @Template("AcmeCalculatorUIBundle:Default:result.html.twig")
     */
    public function compute(Request $request)
    {
        $operation = new Operation();
        $form = $this->formFactory->create("operation", $operation);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $result = $this->calculatorServiceClient->compute($operation->getOperandA(), $operation->getOperandB(), $operation->getOperator());
            $operation->setResult($result);
        }

        return ["operation" => $operation, "form" => $form->createView()];
    }

    /**
     * @var \Acme\CalculatorModelBundle\Service\CalculatorServiceClient
     * @DI\Inject("acme.calculator.model.service.client")
     */
    public $calculatorServiceClient;

    /**
     * @DI\Inject("templating")
     */
    public $templating;

    /**
     * @DI\Inject("form.factory")
     * @var \Symfony\Component\Form\FormFactory
     */
    public $formFactory;
}
