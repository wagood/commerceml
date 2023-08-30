<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Product;

/**
 * Class ProductEvent
 * @package CommerceMLParser
 */
class ProductEvent extends Event {

    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
        parent::__construct($product);
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}