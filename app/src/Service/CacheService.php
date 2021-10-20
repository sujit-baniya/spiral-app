<?php


namespace App\Service;


use App\Drivers\CacheInterface;
use Cycle\ORM\Iterator;
use ReflectionFunction;

class CacheService extends BaseService
{
    /**
     * @var CacheInterface
     */
    public $cacheDriver;

    /**
     * @var int
     */
    private $ttl;

    /**
     * @var string
     */
    private $prefix;

    public function setDriver(CacheInterface $cacheDriver)
    {
        $this->cacheDriver = $cacheDriver;
    }

    public function connect($host, $port = 6379, array $options = [])
    {
        return $this->cacheDriver->connect($host, $port, $options);
    }

    /**
     * @param $key
     * @param $value
     * @param null $timeout
     * @return mixed
     */
    public function set($key, $value, $timeout = null)
    {
        $key = $this->getKeyWithPrefix($key);
        return $this->cacheDriver->set($key, $value, $timeout);
    }

    public function get($key)
    {
        $key = $this->getKeyWithPrefix($key);
        return $this->cacheDriver->get($key);
    }

    public function deletePattern($pattern)
    {
        $keyPattern = $this->getKeyWithPrefix($pattern);
        return $this->cacheDriver->deletePattern($keyPattern);
    }

    /**
     */
    public function remember($key, string $entity, int $timeout, \Closure $closure)
    {
        $key = $this->getKeyWithPrefix($key);
        if ($this->cacheDriver->has($key))
        {
            $data = $this->cacheDriver->get($key);
            return (new Iterator($this->orm, $entity, json_decode($data, true)))->getIterator();
        }
        $result = $closure();
        $value = json_encode($result);
        $this->cacheDriver->set($key, $value, $timeout);
        $data = json_decode($value, true);
        return (new Iterator($this->orm, $entity, $data))->getIterator();
    }

    public function rememberForever($key, string $entity, \Closure $closure)
    {
        $key = $this->getKeyWithPrefix($key);
        if ($this->cacheDriver->has($key))
        {
            return json_decode($this->cacheDriver->get($key));
        }
        $result = $closure();
        $value = json_encode($result);
        $this->cacheDriver->set($key, $value);
        $data = json_decode($value, true);
        return (new Iterator($this->orm, $entity, $data))->getIterator();
    }

    /**
     * @return int
     */
    public function getTtl(): int
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl(int $ttl): void
    {
        $this->ttl = $ttl;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @param $key
     * @return string
     */
    private function getKeyWithPrefix($key): string
    {
        if (empty($this->prefix))
        {
            return $key;
        }
        return $this->prefix . ':' . $key;
    }
}
