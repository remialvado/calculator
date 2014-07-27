<?php

namespace Acme\CalculatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeCalculatorBundle:Default:index.html.twig');
    }

    public function computeAction(Request $request)
    {
        $operandA = $request->get("operand-a");
        $operandB = $request->get("operand-b");
        $operator = $request->get("operator");
        $result = null;
        if ($operator === "add") $result = $operandA + $operandB;
        if ($operator === "substract") $result = $operandA - $operandB;
        if ($operator === "multiply") $result = $operandA * $operandB;
        if ($operator === "divide") $result = $operandA / $operandB;
        return $this->render('AcmeCalculatorBundle:Default:result.html.twig', [
            "operandA" => $operandA,
            "operandB" => $operandB,
            "operator" => $operator,
            "result"   => $result,
        ]);
    }
}
