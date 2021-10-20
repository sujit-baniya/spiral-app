<?php


namespace App\Database;


use App\Helper\StringHelper;
use Carbon\Carbon;
use Cycle\Annotated\Annotation as Cycle;
use ReflectionObject;
use ReflectionProperty;

abstract class Model implements \JsonSerializable
{
    /**
     * @Cycle\Column(type = "bigPrimary")
     */
    public $id;

    /**
     * @Cycle\Column(type = "datetime", name = "created_at")
     */
    public $createdAt;

    /**
     * @Cycle\Column(type = "datetime", name = "updated_at")
     */
    public $updatedAt;

    private $dirtyFields = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function fill(array $data)
    {
        $this->hydrate($this, $data);
    }

    /**
     * @param $entity
     * @param array $data
     *
     */
    public function hydrate($entity, array $data)
    {
        $dirtyFields = [];
        foreach($data as $attr => $val)
        {
            $method = StringHelper::toCamel('set_' . $attr);
            if(is_callable([$entity, $method]))
            {
                $dirtyFields[$attr] = $val;
                $entity->$method($val);
            }
        }
        $this->dirtyFields = $dirtyFields;
    }

    public function getDirtyFields(): array
    {
        return $this->dirtyFields;
    }

    public function toArray(): array
    {
        $flattenFields = [];
        foreach ((new ReflectionObject($this))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $field= StringHelper::toSnake($property->getName());
            $flattenFields[$field] = $property->getValue($this);
        }
        return $flattenFields;
    }

    public function jsonSerialize()
    {
        return $this;
    }
}
