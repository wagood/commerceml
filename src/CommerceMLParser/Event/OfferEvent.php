<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Offer;

/**
 * Class OfferEvent
 * @package CommerceMLParser
 */
class OfferEvent extends Event {
    protected Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        parent::__construct($offer);
    }

    /**
     * @return Offer
     */
    public function getOffer(): Offer
    {
        return $this->offer;
    }
}