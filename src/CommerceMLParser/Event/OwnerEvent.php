<?php
namespace CommerceMLParser\Event;

use CommerceMLParser\Event;
use CommerceMLParser\Model\Types\Partner;

/**
 * Class OwnerEvent
 * @package CommerceMLParser
 */
class OwnerEvent extends Event
{
    protected Partner $partner;

    public function __construct(Partner $partner)
    {
        $this->partner = $partner;
        parent::__construct($partner);
    }

    /**
     * @return Partner
     */
    public function getPartner(): Partner
    {
        return $this->partner;
    }
}
