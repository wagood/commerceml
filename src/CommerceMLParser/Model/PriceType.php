<?php

namespace CommerceMLParser\Model;

use CommerceMLParser\Model\Interfaces\IdModel;

class PriceType implements IdModel
{
    /** @var string */
    protected string $id;
    /** @var string */
    protected string $type;
    /** @var string */
    protected string $currency;

    /**
     * @param \SimpleXMLElement $xml
     * @return PriceType
     */
    public function __construct(\SimpleXMLElement $xml = null)
    {
        if (!is_null($xml)) {
            $this->id = (string)$xml->Ид;
            $this->type = (string)$xml->Наименование;
            $this->currency = (string)$xml->Валюта;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }


}
