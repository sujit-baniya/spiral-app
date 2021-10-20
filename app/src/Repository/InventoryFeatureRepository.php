<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Repository;

use App\Database\InventoryFeature;

class InventoryFeatureRepository extends BaseRepository
{
    public $entity = InventoryFeature::class;
    /**
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $plan = new InventoryFeature();
        $plan->fill($data);
        $this->storeEntity($plan);
        return $plan;
    }

    public function update(array $data, InventoryFeature $plan)
    {
        $plan->fill($data);
        $this->storeEntity($plan);
        return $plan;
    }

    /**
     * @param $id
     * @return object|null
     *
     */
    public function get($id)
    {
        /** @var InventoryFeature $plan */
        return parent::getById($id);
    }

    public function rules($id)
    {
        $data = $this->findByPK($id);
        if($data)
        {
            return $data->rules;
        }
        return [];
    }
}
