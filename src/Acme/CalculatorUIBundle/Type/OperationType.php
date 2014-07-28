<?php

namespace Acme\CalculatorUIBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.form.type.operation")
 * @DI\Tag("form.type", attributes = {"alias" = "operation"})
 * @DI\Tag("monolog.logger", attributes = {"channel" = "formtype"})
 */
class OperationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->logger->debug("prepare Operation FormType");
        $operators = new ObjectChoiceList($this->operatorFactory->getSupportedOperators(), "label", [], null, "id");
        $builder->add('operandA', "operand")
                ->add('operator', 'choice', ["choice_list" => $operators])
                ->add('operandB', "operand")
                ->setAction('compute')
                ->setMethod('GET')
                ->add('compute', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\CalculatorModelBundle\Model\Operation',
            'cascade_validation' => true,
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "operation";
    }

    /**
     * @var \Acme\CalculatorModelBundle\Service\OperatorFactory
     * @DI\Inject("acme.calculator.operator.factory")
     */
    public $operatorFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     * Logger has to be injected using constructor injection to allow monolog to tag it with the proper channel
     */
    public $logger;

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @DI\InjectParams({
     *     "logger" = @DI\Inject("logger")
     * })
     */
    function __construct($logger = null)
    {
        $this->logger = $logger;
    }

} 