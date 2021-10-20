<?php


namespace App\Drivers;


use Redis;

class RedisCache implements CacheInterface
{
    private $client;

    public function __construct()
    {
        $this->client = new Redis();
    }

    public function connect($host, $port = 6379, array $options = [])
    {
        $this->client->connect($host, $port);
    }

    public function set($key, $value, $timeout = null): bool
    {
        return $this->client->set($key, $value, $timeout);
    }

    /**
     * @param string $key
     * @return false|mixed|string
     */
    public function get($key)
    {
        return $this->client->get($key);
    }

    /**
     * @param array|int|string $key
     * @param int|string ...$otherKeys
     * @return int
     */
    public function del($key, ...$otherKeys)
    {
       return $this->client->del($key, $otherKeys);
    }

    public function has($key): bool
    {
        if ($this->client->get($key))
        {
            return true;
        }
        return false;
    }

    /**
     * @param $pattern
     * @return mixed
     *
     */
    public function deletePattern($pattern)
    {
        $iterator = null;
        $count = 100;
        $totalKeys = 0;
        while (false !== ($keys = $this->client->scan($iterator, $pattern, $count))) {
            if (is_array($keys) && !empty($keys)) {
                $totalKeys +=$this->client->del($keys);
            }
        }
        return $totalKeys;
    }
}
