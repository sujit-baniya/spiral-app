<?php
/**
 * {project-name}
 *
 * @author {author-name}
 */
declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation as Cycle;

/**
 * @Cycle\Entity(repository="\App\Repository\InventoryFeatureRuleRepository", mapper="\App\Mapper\TimestampedMapper")
 */
class InventoryFeatureRule extends Model
{
    /**
     * @var integer
     * @Cycle\Column(type = "bigint", name = "inventory_feature_id")
     *
     */
    public $inventoryFeatureId;

    /**
     * @var integer
     * @Cycle\Column(type = "bigint")
     *
     */
    public $ruleId;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $value;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $acl;

    /**
     * @var bool
     * @Cycle\Column(type = "boolean")
     *
     */
    public $isActive;

    public $inventoryFeature;

    /**
     * @Cycle\Relation\BelongsTo(target="Rule")
     *
     */
    public $rule;

    /**
     * @return int
     */
    public function getInventoryFeatureId(): int
    {
        return $this->inventoryFeatureId;
    }

    /**
     * @param int $inventoryFeatureId
     */
    public function setInventoryFeatureId(int $inventoryFeatureId): void
    {
        $this->inventoryFeatureId = $inventoryFeatureId;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getAcl(): string
    {
        return $this->acl;
    }

    /**
     * @param string $acl
     */
    public function setAcl(string $acl): void
    {
        $this->acl = $acl;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getRuleId(): int
    {
        return $this->ruleId;
    }

    /**
     * @param int $ruleId
     */
    public function setRuleId(int $ruleId): void
    {
        $this->ruleId = $ruleId;
    }
}
