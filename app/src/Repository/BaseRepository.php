<?php


namespace App\Repository;


use App\Service\CacheService;
use Cycle\ORM\Iterator;
use Cycle\ORM\ORM;
use Cycle\ORM\ORMInterface;
use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;
use Cycle\ORM\TransactionInterface;
use ReflectionClass;

abstract class BaseRepository extends Repository
{
    /**
     * @var TransactionInterface
     *
     */
    public $db;

    public $cacheService;

    public $eager = [];

    public $entity = "";

    /**
     * @var ORMInterface
     *
     */
    public $orm;

    public function __construct(Select $select, TransactionInterface $db, CacheService $cacheService, ORMInterface $orm)
    {
        parent::__construct($select);
        $this->db = $db;
        $this->cacheService = $cacheService;
        $this->orm = $orm;
    }

    /**
     * @throws \Throwable
     */
    public function storeEntity($object)
    {
        $this->db->persist($object, TransactionInterface::MODE_ENTITY_ONLY);
        $rs = $this->db->run();
        $this->forget($this->getCalledClass());
        return $rs;
    }

    /**
     * @throws \Throwable
     */
    public function destroy($id)
    {
        $object = $this->findByPK($id);
        $this->db->delete($object);
        $rs = $this->db->run();
        $this->forget($this->getCalledClass());
        return $rs;
    }

    /**
     * @return iterable
     *
     */
    public function active(): iterable
    {
        return $this->all(['is_active' => true]);
    }

    /**
     * @param $id
     */
    public function getById($id, bool $cache = true)
    {
        return $this->findByPK($id);
    }

    /**
     * @param array $scope
     * @param array $orderBy
     * @param bool $cache
     * @return iterable
     */
    public function all(array $scope = [], array $orderBy = [], bool $cache = true): iterable
    {
        if ($cache)
        {
            $data = json_decode(json_encode($this->findAll($scope, $orderBy)), true);
            return (new Iterator($this->orm, $this->entity, $data))->getIterator();
        }
        $key = $this->generateHashKey(':all:', $scope);
        return $this->cacheService->remember($key, $this->entity, $this->cacheService->getTtl(), function() use ($scope, $orderBy) {
            return $this->findAll($scope, $orderBy);
        });
    }

    /**
     * @param array $scope
     * @return object|null
     */
    public function one(array $scope = [], bool $cache = true): ?object
    {
        if ($cache)
        {
            $data = json_decode(json_encode($this->findOne($scope)), true);
            return (new Iterator($this->orm, $this->entity, $data))->getIterator();
        }
        $key = $this->generateHashKey(':all:', $scope);
        return $this->cacheService->remember($key, $this->entity, $this->cacheService->getTtl(), function() use ($scope) {
            return $this->findOne($scope);
        });
    }

    public function forget($class)
    {
        $this->forgetAll($class);
        $this->forgetOne($class);
        $this->forgetId($class);
    }

    public function getCalledClass()
    {
        return (new ReflectionClass($this))->getShortName();
    }

    public function forgetAll($class)
    {
        $allKey = $class . ':all:*';
        $this->cacheService->deletePattern($allKey);
    }

    public function forgetOne($class)
    {
        $oneKey = $class . ':one:*';
        $this->cacheService->deletePattern($oneKey);
    }

    public function forgetId($class)
    {
        $idKey = $class . ':id:*';
        $this->cacheService->deletePattern($idKey);
    }

    private function generateHashKey($identifier, array $extra_data): string{
        return $this->getCalledClass() . ':'.$identifier.':'.hash('sha256',json_encode($extra_data));
    }

    public function with(array $eager)
    {
        $this->eager = $eager;
        return $this;
    }

    public function toArray(iterable $iterator): array
    {
        return iterator_to_array($iterator);
    }

    public function toSql(array $scope = [], array $orderBy = []): string
    {
        return $this->select()->where($scope)->orderBy($orderBy)->sqlStatement();
    }
}
