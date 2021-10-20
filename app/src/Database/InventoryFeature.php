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
 * @Cycle\Entity(repository="\App\Repository\InventoryFeatureRepository", mapper="\App\Mapper\TimestampedMapper")
 */
class InventoryFeature extends Model
{
    /**
     * @var integer
     * @Cycle\Column(type = "bigint")
     *
     */
    public $inventoryId;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $name;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $country;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $serviceType;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $numberType;

    /**
     * @var double
     * @Cycle\Column(type = "decimal(11, 4)")
     *
     */
    public $fee;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $period;

    /**
     * @var integer
     * @Cycle\Column(type = "integer")
     *
     */
    public $interval;

    /**
     * @var bool
     * @Cycle\Column(type = "boolean")
     *
     */
    public $isCountryRestricted;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $callbackUrl;

    // Rules(id) <= (ruleId)InventoryFeatureRules(inventoryFeatureId) => InventoryFeatures(id)
    /**
    * @Cycle\Relation\ManyToMany(target = "Rule", though = "InventoryFeatureRule", thoughOuterKey = "ruleId", thoughInnerKey = "inventoryFeatureId", innerKey = "id", outerKey = "id")
    */
    public $rules;

    /**
     * @return mixed
     */
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * @param mixed $inventoryId
     */
    public function setInventoryId($inventoryId): void
    {
        $this->inventoryId = $inventoryId;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * @param mixed $serviceType
     */
    public function setServiceType($serviceType): void
    {
        $this->serviceType = $serviceType;
    }

    /**
     * @return mixed
     */
    public function getNumberType()
    {
        return $this->numberType;
    }

    /**
     * @param mixed $numberType
     */
    public function setNumberType($numberType): void
    {
        $this->numberType = $numberType;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    public function setFee($fee): void
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }

    /**
     * @return mixed
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * @param mixed $interval
     */
    public function setInterval($interval): void
    {
        $this->interval = $interval;
    }

    /**
     * @return mixed
     */
    public function getIsCountryRestricted()
    {
        return $this->isCountryRestricted;
    }

    /**
     * @param mixed $isCountryRestricted
     */
    public function setIsCountryRestricted($isCountryRestricted): void
    {
        $this->isCountryRestricted = $isCountryRestricted;
    }

    /**
     * @return mixed
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param mixed $callbackUrl
     */
    public function setCallbackUrl($callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
