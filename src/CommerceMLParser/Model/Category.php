<?php
namespace CommerceMLParser\Model;

use CommerceMLParser\Model\Interfaces\HasChild;
use CommerceMLParser\Model\Interfaces\IdModel;

/**
 * Class Category
 * @package CommerceMLParser\Model
 */
class Category implements IdModel, HasChild
{
    /** @var string $id */
    protected string $id;
    /** @var string $name */
    protected string $name;
    /** @var bool */
    protected bool $delmark;
    /** @var ?string $parent */
    protected ?string $parent = null;
    /** @var CategoryCollection|Category[]  */
    protected array|CategoryCollection $categories;
    /** @var  PropertyCollection|Property[] */
    protected array|PropertyCollection $properties;

    /**
     * Create instance from file.
     *
     * @param \SimpleXMLElement $xml
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (null === $xml) {
            return;
        }

        $this->id = (string) $xml->Ид;
        $this->name = (string) $xml->Наименование;
        $this->delmark = (string) $xml->ПометкаУдаления === 'true';
        $this->categories = new CategoryCollection();
        $this->properties = new PropertyCollection();
        $this->parent = null;
        if ($xml->Свойства) {
            foreach ($xml->Свойства as $property) {
                $this->properties->add(new Property($property));
            }
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function getDelmark(): bool
    {
        return $this->delmark;
    }

    /**
     * @return ?string
     */
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * Add children category.
     *
     * @param Category $category
     * @return void
     */
    public function addChild($category): void
    {
        $category->parent = $this->id;
        $this->categories->add($category);
    }

    /**
     * @return Category[]|CategoryCollection
     */
    public function getChildren(): CategoryCollection|array
    {
        return $this->categories;
    }

    /**
     * @return Property[]|PropertyCollection
     */
    public function getProperties(): array|PropertyCollection
    {
        return $this->properties;
    }

}
