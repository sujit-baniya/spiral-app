<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Repository;

use App\Database\Rule;
use App\Helper\StringHelper;

class RuleRepository extends BaseRepository
{
    public $entity = Rule::class;
    /**
     * @throws \Throwable
     */
    public function store(array $data)
    {
        $plan = new Rule();
        $data['slug'] = StringHelper::slug($data['name'] ?? null);
        $plan->fill($data);
        $this->storeEntity($plan);
        return $plan;
    }

    public function update(array $data, Rule $plan)
    {
        if(isset($data['name']))
        {
            $data['slug'] = StringHelper::slug($data['name']);
        }
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
        /** @var Rule $plan */
        return parent::getById($id);
    }
}
