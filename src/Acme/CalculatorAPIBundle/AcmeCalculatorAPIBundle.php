<?php

namespace Acme\CalculatorAPIBundle;

use Acme\CalculatorAPIBundle\CompilerPass\OperatorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeCalculatorAPIBundle extends Bundle
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OperatorCompilerPass());
    }
}
