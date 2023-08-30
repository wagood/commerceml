<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Category;
use CommerceMLParser\Model\CategoryCollection;
use CommerceMLParser\ORM\Collection;

/**
 * Class CategoryEvent
 * @package CommerceMLParser
 */
class CategoryEvent extends Event {

    /** @var CategoryCollection|Category[]  */
    protected array|CategoryCollection $categories;

    public function __construct(CategoryCollection $categories)
    {
        $this->categories = $categories;
        parent::__construct($categories);
    }

    /**
     * @return CategoryCollection
     */
    public function getCategories(): CategoryCollection|array
    {
        return $this->categories;
    }

    /**
     * @return CategoryCollection|Category[]
     */
    public function getFlatCategories(): CategoryCollection|array|Collection
    {
        $collectionClass = get_class($this->categories);
        /** @var Collection $collection */
        $collection = new $collectionClass;
        $recursiveIterator = function (CategoryCollection $categories) use ($collection, &$recursiveIterator) {
            /** @var Category $category */
            foreach ($categories as $category) {
                $collection->add($category);
                $recursiveIterator($category->getChildren());
            }
        };
        $recursiveIterator($this->categories);
        return $collection;
    }
}