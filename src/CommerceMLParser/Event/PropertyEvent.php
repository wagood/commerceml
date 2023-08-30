<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Property;

/**
 * Class PropertyEvent
 * @package CommerceMLParser
 */
class PropertyEvent extends Event {

    protected Property $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
        parent::__construct($property);
    }

    /**
     * @return Property
     */
    public function getProperty(): Property
    {
        return $this->property;
    }

}