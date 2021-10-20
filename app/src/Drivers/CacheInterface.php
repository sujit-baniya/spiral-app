<?php


namespace App\Drivers;


interface CacheInterface
{
    public function connect($host, $port = 6379, array $options = []);

    public function set($key, $value, $timeout = null);

    public function get($key);

    public function del($key, ...$otherKeys);

    public function has($key): bool;

    public function deletePattern($pattern);
}
