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
 * @Cycle\Entity(repository="\App\Repository\RuleRepository", mapper="\App\Mapper\TimestampedMapper")
 */
class Rule extends Model
{
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
    public $slug;

    /**
     * @var string
     * @Cycle\Column(type = "string")
     *
     */
    public $description;

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

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
