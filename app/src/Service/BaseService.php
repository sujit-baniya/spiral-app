<?php


namespace App\Service;


use Cycle\ORM\ORMInterface;
use Spiral\Core\Container\SingletonInterface;

abstract class BaseService implements SingletonInterface
{
    /**
     * @var ORMInterface
     *
     */
    protected $orm;

    public function __construct(ORMInterface $orm)
    {
        $this->orm = $orm;
    }
}
