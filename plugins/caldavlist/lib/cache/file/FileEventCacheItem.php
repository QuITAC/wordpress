<?php

use Psr\Cache\CacheItemInterface;

class FileEventCacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    private $eventData;

    /**
     * @var DateTime
     */
    private $expirationDate = null;

    /**
     * @inheritDoc
     */
    public function getKey()
    {
        return 'events';
    }

    /**
     * @inheritDoc
     */
    public function get()
    {
        return $this->eventData;
    }

    /**
     * @inheritDoc
     */
    public function isHit()
    {
        if ($this->eventData) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function set($value)
    {
        $this->eventData = $value;
    }

    /**
     * @inheritDoc
     */
    public function expiresAt($expiration)
    {
        $this->expirationDate = $expiration;
    }

    /**
     * @inheritDoc
     */
    public function expiresAfter($time)
    {
        if (!$time) {
            $this->expirationDate = null;
        } else {
            if (is_int($time)) {
                $interval = DateInterval::createFromDateString(strval($time) . ' seconds');
            } else {
                $interval = $time;
            }
            $this->expirationDate = (new DateTime())->add($interval);
        }
    }
}