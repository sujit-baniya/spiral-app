<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Repository;

use App\Database\InventoryFeatureRule;

class InventoryFeatureRuleRepository extends BaseRepository
{
    public $entity = InventoryFeatureRule::class;
    /**
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $plan = new InventoryFeatureRule();
        $plan->fill($data);
        $this->storeEntity($plan);
        return $plan;
    }

    public function update(array $data, InventoryFeatureRule $plan)
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
        /** @var InventoryFeatureRule $plan */
        return parent::getById($id);
    }
}
