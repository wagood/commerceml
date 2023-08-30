<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\PriceType;

/**
 * Class PriceTypeEvent
 * @package CommerceMLParser
 */
class PriceTypeEvent extends Event {

    protected PriceType $priceType;

    public function __construct(PriceType $priceType)
    {
        $this->priceType = $priceType;
        parent::__construct($priceType);
    }

    /**
     * @return PriceType
     */
    public function getPriceType(): PriceType
    {
        return $this->priceType;
    }

}