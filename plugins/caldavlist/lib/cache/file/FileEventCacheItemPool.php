<?php

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class FileEventCacheItemPool implements CacheItemPoolInterface
{

    private $cacheDir = WP_PLUGIN_DIR . '/caldavlist/cache';

    /**
     * @var CacheItemInterface
     */
    private $defferedItems = [];

    /**
     * @inheritDoc
     */
    public function getItem($key)
    {
        if (strpos($key, 'events') !== False) {
            if (!file_exists($this->cacheDir)) {
                mkdir($this->cacheDir);
                return new FileEventCacheItem();
            } else {
                $files = scandir($this->cacheDir);
                if (!count($files)) {
                    return new FileEventCacheItem();
                } else {
                    rsort($files, SORT_DESC);
                    $newestFile = $files[0];
                    $newestFileTimestamp = intval(str_replace('.cache', '', $newestFile));
                    $now = new DateTime();
                    if (($now->getTimestamp() - $newestFileTimestamp) > 30) {
                        return new FileEventCacheItem();
                    }

                    $content = file_get_contents($this->cacheDir . '/' . $newestFile);
                    $item = new FileEventCacheItem();
                    $item->set($content);
                    return $item;
                }
            }
        } else {
            throw new FileEventInvalidArgumentException('This pool only serves "events" key');
        }
    }

    /**
     * @inheritDoc
     */
    public function getItems(array $keys = array())
    {
        $items = [];
        foreach ($keys as $key) {
            $items[] = $this->getItem($key);
        }

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function hasItem($key)
    {
        if (strpos($key, 'events') !== False) {
            if (file_exists($this->cacheDir) && is_dir($this->cacheDir)) {
                $files = scandir($this->cacheDir);
                return !!count($files);
            }
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $result = true;
        if (file_exists($this->cacheDir) && is_dir($this->cacheDir)) {
            $files = scandir($this->cacheDir);
            foreach ($files as $file) {
                $localResult = unlink($this->cacheDir . '/' . $file);
                if (!$localResult) {
                    $result = false;
                }
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function deleteItem($key)
    {
        if (!$this->hasItem($key)) {
            throw new InvalidArgumentException("invalid key");
        }
        if (file_exists($this->cacheDir) && is_dir($this->cacheDir)) {
            $files = scandir($this->cacheDir);
            foreach ($files as $file) {
                unlink($this->cacheDir . '/' . $file);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteItems(array $keys)
    {
        foreach ($keys as $key) {
            $this->deleteItem($key);
        }
    }

    /**
     * @inheritDoc
     */
    public function save(CacheItemInterface $item)
    {
        file_put_contents($this->cacheDir . '/' . (new DateTime())->getTimestamp() . '.cache', $item->get());
    }

    /**
     * @inheritDoc
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        $this->defferedItems[] = $item;
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        foreach ($this->defferedItems as $item) {
            $this->save($item);
        }
    }
}