<?php

namespace Acme\CalculatorAPIBundle\Service;

use Acme\CalculatorAPIBundle\Model\History;
use Acme\CalculatorAPIBundle\Model\HistoryItem;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.calculator.api.history")
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
        $content = $this->cache->fetch(self::CACHE_KEY);
        if (!$content) {
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
} 