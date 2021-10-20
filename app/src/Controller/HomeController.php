<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Controller;

use App\Job\Ping;
use App\Repository\InventoryFeatureRepository;
use Spiral\Prototype\Traits\PrototypeTrait;

class HomeController
{
    use PrototypeTrait;

    public function index(InventoryFeatureRepository $repository)
    {
        $rules = $repository->rules(1);
        foreach($rules as $rule)
        {
            dump($rules->getPivot($rule));
        }
        return 'test';
    }

    /**
     * Example of exception page.
     *
     * @throws \Error
     */
    public function exception(): void
    {
        echo $undefined;
    }

    /**
     * @return string
     */
    public function ping(): string
    {
        $jobID = $this->queue->push(Ping::class, [
            'value' => 'hello world',
        ]);

        return sprintf('Job ID: %s', $jobID);
    }
}
