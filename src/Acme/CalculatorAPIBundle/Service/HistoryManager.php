<?php

namespace Acme\CalculatorAPIBundle\Service;

use Acme\CalculatorAPIBundle\Model\History;
use Acme\CalculatorAPIBundle\Model\HistoryItem;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.api.history")
 * @DI\Tag("monolog.logger", attributes = {"channel" = "history"})
 */
class HistoryManager
{
    const CACHE_KEY = "acme.api.history";
    const FORMAT = "json";
    const LIFETIME = 84400;

    /**
     * @return History
     */
    public function getHistory()
    {
        $this->logger->debug("Get history");
        $content = $this->cache->fetch(self::CACHE_KEY);
        if (!$content) {
            $this->logger->warning("History does not exist");
            return new History();
        }
        return $this->serializer->deserialize($content, "Acme\CalculatorAPIBundle\Model\History", self::FORMAT);
    }

    /**
     * @param History $history
     * @return bool
     */
    public function saveHistory($history)
    {
        $this->logger->debug("save history with " . $history->count() . " item(s)");
        $content = $this->serializer->serialize($history, self::FORMAT);
        return $this->cache->save(self::CACHE_KEY, $content, self::LIFETIME);
    }

    /**
     * @param string $type
     * @param \Acme\CalculatorModelBundle\Model\Operation $operation
     * @param \DateTime $date
     * @param string $userAgent
     * @return bool
     */
    public function add($type, $operation, $date, $userAgent)
    {
        $this->logger->debug("add an historyItem into history for $type");
        $history = $this->getHistory();
        $history->add(new HistoryItem($date, $type, $operation, $userAgent));
        return $this->saveHistory($history);
    }

    public function purge()
    {
        $this->saveHistory(new History());
    }

    /**
     * @DI\Inject("acme.cache.apc")
     * @var \Doctrine\Common\Cache\Cache
     */
    public $cache;

    /**
     * @var \JMS\Serializer\SerializerInterface
     * @DI\Inject("serializer")
     */
    public $serializer;

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
    function __construct($logger)
    {
        $this->logger = $logger;
    }
} 