<?php

namespace Acme\CalculatorUIBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

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

    public function compute(Request $request)
    {

        $operandA = $request->get("operand-a");
        $operandB = $request->get("operand-b");
        $operator = $request->get("operator");

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiEndpoint . "/api/v1/$operandA/$operandB/$operator.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        if ($output === false) {
            return new Response("", 500);
        }
        curl_close($ch);

        return $this->render("AcmeCalculatorUIBundle:Default:result.html.twig", json_decode($output, true));
    }

    /**
     * @var string
     * @DI\Inject("%acme.calculator.api.endpoint%")
     */
    public $apiEndpoint;

    /**
     * @DI\Inject("templating")
     */
    public $templating;
}
