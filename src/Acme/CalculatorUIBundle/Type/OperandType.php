<?php

namespace Acme\CalculatorUIBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.form.type.operand")
 * @DI\Tag("form.type", attributes = {"alias" = "operand"})
 * @DI\Tag("monolog.logger", attributes = {"channel" = "formtype"})
 */
class OperandType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->logger->debug("prepare Operand FormType");
        $builder->add('value');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\CalculatorModelBundle\Model\Operand',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "operand";
    }

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