<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Warehouse;

/**
 * Class WarehouseEvent
 * @package CommerceMLParser
 */
class WarehouseEvent extends Event {

    protected Warehouse $warehouse;

    public function __construct(Warehouse $priceType)
    {
        $this->warehouse = $priceType;
        parent::__construct($priceType);
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }
}
